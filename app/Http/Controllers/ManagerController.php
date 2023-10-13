<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\QuoteRequest;
use App\Models\QuoteServiceRequest;
use App\Models\QuoteApprove;
use App\Models\QuoteComp;
use App\Models\QuoteDataEquipment;
use App\Models\QuoteDataTrailerSize;
use App\Models\User;
use App\Models\Customer;
use App\Models\Carrier;
use App\Models\Driver;
use App\Models\Track;
use App\Mail\CarrierSendQuote;
use App\Classes\Quote;
use App\Classes\VCode;

class ManagerController extends Controller
{
    /**
     * Get Every State Quote Counts
     *
     * @return response()
     */
    private function getStatusCount()
    {
        $statusCount = [
            "quote_all" => QuoteRequest::where("status", "<=", 12)
                                ->where("status", ">=", 1)
                                ->count(),
            "quote_requested" => QuoteRequest::where("status", 1)->count(),
            "quote_checked" => QuoteRequest::where("status", 2)->count(),
            "quote_approved" => QuoteRequest::where("status", 3)->count(),
            "quote_rejected" => QuoteRequest::where("status", 4)->count(),
            "quote_confirmed" => QuoteRequest::where("status", 5)->count(),
            "quote_submitted" => QuoteRequest::where("status", 6)->count(),
            "quote_published" => QuoteRequest::where("status", 7)->count(),
            "quote_ongoing" => QuoteRequest::where("status", ">", 7)->where("status", "<", 12)->count(),
            "quote_completed" => QuoteRequest::where("status", 12)->count()
        ];

        return $statusCount;
    }

    /**
     * Get Manager Monthly Data
     *
     * @return Response
     */
    public function getManagerMonthlyData()
    {
        $data = DB::table('quote_requests')
                        ->rightJoin(DB::raw('(SELECT CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as date
                                             FROM (SELECT 0 as a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
                                                   UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7
                                                   UNION ALL SELECT 8 UNION ALL SELECT 9) as a
                                             CROSS JOIN (SELECT 0 as a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
                                                         UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7
                                                         UNION ALL SELECT 8 UNION ALL SELECT 9) as b
                                             CROSS JOIN (SELECT 0 as a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
                                                         UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7
                                                         UNION ALL SELECT 8 UNION ALL SELECT 9) as c
                                             WHERE (a.a + (10 * b.a) + (100 * c.a)) < 31
                                             ORDER BY date DESC) as dates'), function ($join) {
                        $join->on(DB::raw('DATE(quote_requests.updated_at)'), '=', 'dates.date')
                                                    ->where('quote_requests.status', '=', '13');
                                        })
                        ->select(DB::raw("DATE_FORMAT(dates.date, '%m/%d') as date"), DB::raw('COALESCE(count(quote_requests.id), 0) as count'))
                        ->groupBy('date')
                        ->orderBy('date', 'ASC')
                        ->get();

        return response()->json($data);
    }

    /**
     * Get Manager Yearly Data
     *
     * @return Response
     */
    public function getManagerYearlyData()
    {
        $data = DB::table(DB::raw('(SELECT 1 as month UNION SELECT 2 as month UNION SELECT 3 as month UNION SELECT 4 as month UNION SELECT 5 as month UNION SELECT 6 as month UNION SELECT 7 as month UNION SELECT 8 as month UNION SELECT 9 as month UNION SELECT 10 as month UNION SELECT 11 as month UNION SELECT 12 as month) as months'))
                     ->leftJoin(DB::raw('(SELECT MONTH(quote_requests.updated_at) as month, COUNT(quote_requests.id) as count FROM quote_requests WHERE YEAR(quote_requests.updated_at) = YEAR(NOW()) AND quote_requests.status = 13 GROUP BY MONTH(quote_requests.updated_at)) as table_count'), 'months.month', '=', 'table_count.month')
                     ->select(DB::raw("DATE_FORMAT(CONCAT('2023-', months.month, '-01'), '%b') as month_name"), DB::raw('COALESCE(table_count.count, 0) as count'))
                     ->orderBy('months.month', 'ASC')
                     ->get();

        return response()->json($data);
    }

    /**
     * To Manager Dashboard
     *
     * @return View
     */
    public function toManagerDashboard()
    {
        $num_total_quotes = QuoteRequest::where("status", 13)->count();
        $num_month_quotes = QuoteRequest::where("status", 13)
                                ->where("updated_at", ">=", date("Y-m-d", strtotime("first day of this month")))
                                ->count();
        $num_ongoing_quotes = QuoteRequest::where("status", ">=", 1)
                                ->where("status", "<=", 12)
                                ->count();
        $num_deleted_quotes = QuoteRequest::where("status", "<", 0)->count();

        $quotes = DB::table("quote_requests")
            ->join("customers", "quote_requests.id", "=", "customers.quote_id")
            ->join("carriers", "quote_requests.id", "=", "carriers.quote_id")
            ->join("quote_approves", "quote_requests.id", "=", "quote_approves.quote_id")
            ->join("quote_comps", "quote_requests.id", "=", "quote_comps.quote_id")
            ->select(
                "customers.first_name as customer_fname",
                "customers.last_name as customer_lname",
                "quote_comps.deliver_cost",
                "carriers.legal_name",
                "quote_approves.total_cost",
                "quote_requests.*"
            )
            ->where("status", 13)
            ->orderBy("updated_at", "desc")
            ->take(100)
            ->get();


        // $num_month_quotes = date("Y-m-d", strtotime("first day of this month"));

        return view("manager.dashboard")
            ->with("num_total_quotes", $num_total_quotes)
            ->with("num_month_quotes", $num_month_quotes)
            ->with("num_ongoing_quotes", $num_ongoing_quotes)
            ->with("num_deleted_quotes", $num_deleted_quotes)
            ->with("rate_completed", $num_total_quotes?round($num_total_quotes * 10000 / ($num_total_quotes + $num_deleted_quotes)) / 100:0)
            ->with("quotes", $quotes);
    }

    /**
     * To Manager Requested Quote Page
     *
     * @return View
     */
    public function toManagerRequestedQuotes()
    {
        $quotes = DB::table("quote_requests")
            ->join("customers", "quote_requests.id", "=", "customers.quote_id")
            ->select(
                "customers.*",
                "quote_requests.*"
            )
            ->where("status", 1)
            ->get();

        return view("manager.quotes")
            ->with("status", 1)
            ->with("status_count", $this->getStatusCount())
            ->with("quotes", $quotes);
    }

    /**
     * To Manager Checked Quote Page
     *
     * @return View
     */
    public function toManagerCheckedQuotes()
    {
        $quotes = DB::table("quote_requests")
            ->join("customers", "quote_requests.id", "=", "customers.quote_id")
            ->select(
                "customers.*",
                "quote_requests.*"
            )
            ->where("status", 2)
            ->get();

        return view("manager.quotes")
            ->with("status", 2)
            ->with("status_count", $this->getStatusCount())
            ->with("quotes", $quotes);
    }

    /**
     * To Manager Approved Quote Management Page
     *
     * @return View
     */
    public function toManagerApprovedQuotes()
    {
        $quotes = DB::table("quote_requests")
            ->join("customers", "quote_requests.id", "=", "customers.quote_id")
            ->select(
                "customers.*",
                "quote_requests.*"
            )
            ->where("status", 3)
            ->get();

        return view("manager.quotes")
            ->with("status", 3)
            ->with("status_count", $this->getStatusCount())
            ->with("quotes", $quotes);
    }

    /**
     * To Manager Rejected Quote Management Page
     *
     * @return View
     */
    public function toManagerRejectedQuotes()
    {
        $quotes = DB::table("quote_requests")
            ->join("customers", "quote_requests.id", "=", "customers.quote_id")
            ->select(
                "customers.*",
                "quote_requests.*"
            )
            ->where("status", 4)
            ->get();

        return view("manager.quotes")
            ->with("status", 4)
            ->with("status_count", $this->getStatusCount())
            ->with("quotes", $quotes);
    }


    /**
     * To Manager Confirmed Quote Management Page
     *
     * @return View
     */
    public function toManagerConfirmedQuotes()
    {
        $quotes = DB::table("quote_requests")
            ->join("customers", "quote_requests.id", "=", "customers.quote_id")
            ->select(
                "customers.*",
                "quote_requests.*"
            )
            ->where("status", 5)
            ->get();

        return view("manager.quotes")
            ->with("status", 5)
            ->with("status_count", $this->getStatusCount())
            ->with("quotes", $quotes);
    }

    /**
     * To Manager Quote Detail Page
     *
     * @param Request $id
     * @return View
     */
    public function toManagerQuoteDetails($id)
    {
        $quoteReq = QuoteRequest::find($id);

        if(!$quoteReq || $quoteReq->status < 0) {
            return view("manager.quote_none")
                ->withErrors(["message" => "There is no quote exist."]);
        };

        $user = Customer::where("quote_id", $id)->first();
        $equipment = QuoteDataEquipment::where("equipmentId", $quoteReq->equipment)->get();
        $trailerSize = QuoteDataTrailerSize::where("trailerSizeId", $quoteReq->trailerSize)->get();
        $quoteReq->equipment_name = $equipment[0]->equipmentName . " (". $trailerSize[0]->trailerSizeName .")";
        $quoteApp = QuoteApprove::where("quote_id", $id)->first();
        $quoteComp = QuoteComp::where("quote_id", $id)->first();
        $carrier = Carrier::where("quote_id", $id)->first();
        $driver = Driver::where("quote_id", $id)->first();
        $location = Track::latest()->first();
        $quoteService = QuoteServiceRequest::where("id_alias", $id)->get();
        //dd(count($quoteService));
        //$carriers = Carrier::get();

        return view("manager.quote_details")
            ->with("user", $user)
            ->with("quoteReq", $quoteReq)
            ->with("quoteApp", $quoteApp)
            ->with("quoteComp", $quoteComp)
            ->with("carrier", $carrier)
            ->with("driver", $driver)
            ->with("location", $location)
            ->with("quoteService", $quoteService);
    }

    /**
     * To Manager Quote Detail Page
     *
     * @param Request $id
     * @return View
     */
    public function toManagerQuoteDetailsEdit($id)
    {
        $quoteReq = QuoteRequest::find($id);

        if(!$quoteReq || $quoteReq->status < 0) {
            return view("manager.quote_none")
                ->withErrors(["message" => "There is no quote exist."]);
        };

        $user = Customer::where("quote_id", $id)->first();
        $equipments = QuoteDataEquipment::get();
        $trailerSizes = QuoteDataTrailerSize::get();

        return view("manager.quote_edit")
            ->with("user", $user)
            ->with("equipments", $equipments)
            ->with("trailerSizes", $trailerSizes)
            ->with("quoteReq", $quoteReq);
    }

    /**
     * Update Quote
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function quoteUpdate(Request $request)
    {
        $quoteReqOrg = QuoteRequest::find($request->quoteId);
        $quoteReq = QuoteRequest::find($request->quoteId);

        $quoteReq->pickup = $request->pickupCity;
        $quoteReq->delivery = $request->deliveryCity;
        $quoteReq->pickupDate = $request->pickupDate;
        $quoteReq->deliveryDate = $request->deliveryDate;
        $quoteReq->commodity = $request->commodity;
        $quoteReq->dimension = $request->dimension;
        $quoteReq->weight = $request->weight;
        $quoteReq->temperature = $request->temperature;
        $quoteReq->equipment = $request->equipment;
        $quoteReq->trailerSize = $request->trailerSize;

        if (!$quoteReqOrg->equals($quoteReq)) {
            $quoteReq->save();
            //🚫🚫🚫🚫🚫
            // Send Email ?????????????????????????????????????????????????????????????????????????

            return redirect()->route("manager.quote.details", $quoteReq->id)
                ->withErrors(["message" => "Order data updated."]);
        };

        return redirect()->back()
            ->withSuccess("No date updated.");
    }

    /**
     * Confirm Quote
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    // public function toManagerConfirmQuote(Request $request)
    // {
    //     $quoteReq = QuoteRequest::find($request->quote_id);
    //     $quoteReq->status = 5;
    //     $quoteReq->save();

    //     $carrier = Carrier::find($request->carrier_id);
    //     $carrier->quote_id = $request->quote_id;
    //     $carrier->save();

    //     return redirect()->back()
    //         ->withSuccess("Carrier selected.");
    // }

    /**
     * Confirmed Quote Cancel
     *
     * @param $id
     * @return \Illuminate\Routing\Redirector
     */
    // public function toManagerConfirmCancelQuote($id)
    // {
    //     $quoteReq = QuoteRequest::find($id);
    //     $quoteReq->status = 3;
    //     $quoteReq->save();

    //     return redirect()->back()
    //         ->withSuccess("Carrier info reset.");
    // }

    /**
     * Rate Conf Submit
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function quoteCompSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'quote_id' => 'required|numeric',
            'deliver_cost' => 'required|numeric',
            'company_sign' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        } else {
            $quote = QuoteComp::updateOrCreate(
                ["quote_id" => $request->quote_id],
                [
                    "deliver_cost" => $request->deliver_cost,
                    "company_carrier_comment" => $request->company_carrier_comment,
                    "company_sign" => $request->company_sign
                ]
            );

            $carrier = Carrier::where("quote_id", $request->quote_id)->first();
            if(!$carrier->email_address) {
                $carrier->email_address = $request->email;
            };
            $carrier->verify_code = (new VCode)->generateCode();
            $carrier->save();

            QuoteRequest::find($request->quote_id)->update(["status" => 5]);

            /* Send Email */
            $carrier_email = $carrier->email_address;
            $verify_code = $carrier->verify_code;
            $carrier_dot_number = $carrier->dot_number;
            $carrier_name = $carrier->legal_name;

            //🚫🚫🚫🚫🚫
            //Mail::to($carrier_email)->send(new CarrierSendQuote($verify_code, $carrier_dot_number, $carrier_name));

            return redirect()->back()
                ->withSuccess("Company quote request is successfully submitted via email.");
        };
    }

    /**
     * Confirmed Quote
     *
     * @param $id
     * @return \Illuminate\Routing\Redirector
     */
    public function quoteCompConfirm($id)
    {
        $quoteReq = QuoteRequest::find($id);
        $quoteReq->status = 7;
        $quoteReq->save();

        return redirect()->back()
            ->withSuccess("Rate Conformation is sent to carrier.");
    }

    /**
     * To Manager Submitted Quote Management Page
     *
     * @return View
     */
    public function toManagerSubmittedQuotes()
    {
        $quotes = DB::table("quote_requests")
            ->join("customers", "quote_requests.id", "=", "customers.quote_id")
            ->select(
                "customers.*",
                "quote_requests.*"
            )
            ->where("status", 6)
            ->get();

        return view("manager.quotes")
            ->with("status", 6)
            ->with("status_count", $this->getStatusCount())
            ->with("quotes", $quotes);
    }

    /**
     * To Manager Published Quote Management Page
     *
     * @return View
     */
    public function toManagerPublishedQuotes()
    {
        $quotes = DB::table("quote_requests")
            ->join("customers", "quote_requests.id", "=", "customers.quote_id")
            ->select(
                "customers.*",
                "quote_requests.*"
            )
            ->where("status", 7)
            ->get();

        return view("manager.quotes")
            ->with("status", 7)
            ->with("status_count", $this->getStatusCount())
            ->with("quotes", $quotes);
    }

    /**
     * To Manager On Going Quote Page
     *
     * @return View
     */
    public function toManagerOnGoingQuotes()
    {
        $quotes = DB::table("quote_requests")
            ->where("status", ">", 7)
            ->where("status", "<", 12)
            ->join("customers", "quote_requests.id", "=", "customers.quote_id")
            ->join("status_descriptions", "quote_requests.status", "=", "status_descriptions.status_id")
            ->select(
                "customers.*",
                "status_descriptions.title as status_description",
                "quote_requests.*"
            )
            ->get();
        return view("manager.quotes")
            ->with("status", 8)
            ->with("status_count", $this->getStatusCount())
            ->with("quotes", $quotes);
    }

    /**
     * To Manager Completed Quote Management Page
     *
     * @return View
     */
    public function toManagerCompletedQuotes()
    {
        $quotes = DB::table("quote_requests")
            ->join("customers", "quote_requests.id", "=", "customers.quote_id")
            ->select(
                "customers.*",
                "quote_requests.*"
            )
            ->where("status", 12)
            ->get();
        return view("manager.quotes")
            ->with("status", 12)
            ->with("status_count", $this->getStatusCount())
            ->with("quotes", $quotes);
    }

    /**
     * To Manager All Quotes Page
     *
     * @return View
     */
    public function toManagerQuotesAll()
    {
        $quotes = QuoteRequest::where("status", "<", 13)
                ->where("status", ">=", 1)
                ->orderBy("status")->get();

        return view("manager.quotes_all")
            ->with("quotes", $quotes);
    }

    /**
     * Get Carrier info by MC number
     *
     * @return \Illuminate\Http\Response
     */
    public function getCarrierMC(Request $request)
    {
        ////////////////////////////////////////////////////////////////
















        $carrier = Carrier::where("mc_number", $request->mc_number)
                            ->orWhere("mc_number", "MC-".$request->mc_number)
                            ->first();

        if ($carrier) {
            return redirect()->back()
                ->withInput()
                ->withSuccess("Carrier information found.")
                ->with("carrier_selected", $carrier);
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors(["message"=>"There is no exist carrier with the MC number."]);
        }
    }

    /**
     * Get Carrier info by US DOT number
     *
     * @return Redirctor
     */
    public function getCarrierDOT(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quote_id' => 'required|numeric',
            'dot_number' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        } else {
            // $carrier_selected = DB::connection('fmcsa')->table('fmcsa_census1_2023may')
            //                 ->where("DOT_NUMBER", $request->dot_number)
            //                 ->first();

            //📌📌📌📌📌📌📌📌📌📌📌📌📌📌📌📌📌📌📌📌📌

            $carrier_selected = true;

            if ($carrier_selected) {
                $carrier = Carrier::updateOrCreate(
                    ["quote_id" => $request->quote_id],
                    [
                        // "dot_number" => $carrier_selected->DOT_NUMBER,
                        // "legal_name" => $carrier_selected->LEGAL_NAME,
                        // "dba_name" => $carrier_selected->DBA_NAME,
                        // "carrier_operation" => $carrier_selected->CARRIER_OPERATION,
                        // "phy_street" => $carrier_selected->PHY_STREET,
                        // "phy_city" => $carrier_selected->PHY_CITY,
                        // "phy_state" => $carrier_selected->PHY_STATE,
                        // "phy_zip" => $carrier_selected->PHY_ZIP,
                        // "phy_country" => $carrier_selected->PHY_COUNTRY,
                        // "telephone" => $carrier_selected->TELEPHONE,
                        // "fax" => $carrier_selected->FAX,
                        // "email_address" => $carrier_selected->EMAIL_ADDRESS,
                        // "mcs150_date" => date("Y-m-d", strtotime($carrier_selected->MCS150_DATE)),
                        // "mcs150_mileage" => $carrier_selected->MCS150_MILEAGE,
                        // "mcs150_mileage_year" => date("Y", strtotime($carrier_selected->MCS150_MILEAGE_YEAR)),
                        // "add_date" => date("Y-m-d", strtotime($carrier_selected->ADD_DATE)),
                        // "op_other" => $carrier_selected->OP_OTHER

                        "dot_number" => "1001755",
                        "legal_name" => "B & M WASTE SERVICE INC",
                        "dba_name" => null,
                        "carrier_operation" => "C",
                        "phy_street" => "2115 RANGE LINE ROAD",
                        "phy_city" => "MANITOWOC",
                        "phy_state" => "WI",
                        "phy_zip" => "54220",
                        "phy_country" => "US",
                        "telephone" => "(920) 758-3400",
                        "fax" => "(920) 758-3336",
                        "email_address" => "fernandojrsantana@gmail.com",
                        "mcs150_date" => date("Y-m-d", strtotime("14-May-21")),
                        "mcs150_mileage" => 250,
                        "mcs150_mileage_year" => 2020,
                        "add_date" => date("Y-m-d", strtotime("30-Jan-02")),
                        "op_other" => "N"
                    ]
                );
                return redirect()->back()
                    ->withInput()
                    ->withSuccess("Carrier information found.")
                    ->with("carrier_selected", $carrier);
            } else {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(["message"=>"There is no exist carrier with the DOT number."]);
            }
        };
    }

    /**
     * To Manager Carrier Management Page
     *
     * @return View
     */
    public function toManagerCarrier()
    {
        $carriers = Carrier::groupBy('dot_number')->get();
        return view("manager.carriers")
            ->with("carriers", $carriers);
    }

    /**
     * To Manager Invoice Page
     *
     * @return View
     */
    public function toManagerInvoices()
    {
        $quotes = DB::table("quote_requests")
                ->join("quote_comps", "quote_comps.quote_id", "quote_requests.id")
                ->where("quote_requests.status", 13)
                ->select("quote_comps.*", "quote_requests.*")
                ->orderBy("quote_requests.updated_at", "desc")
                ->get();

        return view("manager.invoices")
            ->with("quotes", $quotes);
    }

    /**
     * To Manager Carrier Invoice Page
     *
     * @return View
     */
    public function toManagerInvoiceCarrier($id)
    {
        $quote = (new Quote)->getQuote($id);

        if ($quote && $quote->status == 13) {
            return view("manager.invoice_carrier")
                ->with("quote", $quote);
        } else {
            return abort(404);
        };
    }

    /**
     * To Manager Customer Invoice Page
     *
     * @return View
     */
    public function toManagerInvoiceCustomer($id)
    {
        $quote = (new Quote)->getQuote($id);

        if ($quote && $quote->status == 13) {
            return view("manager.invoice_customer")
                ->with("quote", $quote);
        } else {
            return abort(404);
        };
    }
}
