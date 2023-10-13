<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\QuoteRequest;
use App\Models\QuoteApprove;
use App\Models\QuoteComp;
use App\Models\QuoteDataEquipment;
use App\Models\QuoteDataTrailerSize;
use App\Models\User;
use App\Models\Customer;
use App\Models\QuoteServiceRequest;
use App\Mail\CustomerConfirm;
use App\Mail\CustomerQuoteCreate;
use App\Mail\CustomerVerify;
// use App\Classes\Quote;

class QuoteController extends Controller
{
    /*========================================================    âœ… APIs     =================================================*/
    /**
     * Get all Requested Quotes
     *
     * @return \Illuminate\Http\Response
     */
    public function quoteGetRequestedAll()
    {
        $quotes = DB::table("quote_requests")
            ->join("users", "quote_requests.customer_id", "=", "users.id")
            ->select(
                "users.*",
                "quote_requests.*"
            )
            ->where("status", 1)
            ->orderBy("quote_requests.created_at", "desc")
            ->get();
        $response = [];
        $response["data"] = $quotes;
        return response()->json($response);
    }

    /**
     * Get all Checked Quotes
     *
     * @return \Illuminate\Http\Response
     */
    public function quoteGetCheckedAll()
    {
        $quotes = DB::table("quote_requests")
            ->join("users", "quote_requests.customer_id", "=", "users.id")
            ->select(
                "users.*",
                "quote_requests.*"
            )
            ->where("status", 2)
            ->get();
        $response = [];
        $response["data"] = $quotes;
        return response()->json($response);
    }

    /**
     * Get all Approved Quotes
     *
     * @return \Illuminate\Http\Response
     */
    public function quoteGetApprovedAll()
    {
        $quotes = DB::table("quote_requests")
            ->join("users", "quote_requests.customer_id", "=", "users.id")
            ->select(
                "users.*",
                "quote_requests.*"
            )
            ->where("status", 3)
            ->get();
        $response = [];
        $response["data"] = $quotes;
        return response()->json($response);
    }

    /**
     * Get all Rejected Quotes
     *
     * @return \Illuminate\Http\Response
     */
    public function quoteGetRejectedAll()
    {
        $quotes = DB::table("quote_requests")
            ->join("users", "quote_requests.customer_id", "=", "users.id")
            ->select(
                "users.*",
                "quote_requests.*"
            )
            ->where("status", 4)
            ->get();
        $response = [];
        $response["data"] = $quotes;
        return response()->json($response);
    }

    /**
     * Get all Confirmed Quotes
     *
     * @return \Illuminate\Http\Response
     */
    public function quoteGetConfirmedAll()
    {
        $quotes = DB::table("quote_requests")
            ->join("users", "quote_requests.customer_id", "=", "users.id")
            ->select(
                "users.*",
                "quote_requests.*"
            )
            ->where("status", 5)
            ->get();
        $response = [];
        $response["data"] = $quotes;
        return response()->json($response);
    }

    /**
     * Get all Submitted Quotes
     *
     * @return \Illuminate\Http\Response
     */
    public function quoteGetSubmittedAll()
    {
        $quotes = DB::table("quote_requests")
            ->join("users", "quote_requests.customer_id", "=", "users.id")
            ->select(
                "users.*",
                "quote_requests.*"
            )
            ->where("status", 6)
            ->get();
        $response = [];
        $response["data"] = $quotes;
        return response()->json($response);
    }


    /**
     * Get all Published Quotes
     *
     * @return \Illuminate\Http\Response
     */
    public function quoteGetPublishedAll()
    {
        $quotes = DB::table("quote_requests")
            ->join("users", "quote_requests.customer_id", "=", "users.id")
            ->select(
                "users.*",
                "quote_requests.*"
            )
            ->where("status", 7)
            ->get();
        $response = [];
        $response["data"] = $quotes;
        return response()->json($response);
    }

    /**
     * Get all On Going Quotes
     *
     * @return \Illuminate\Http\Response
     */
    public function quoteGetOnGoingAll()
    {
        $quotes = QuoteRequest::where("status", ">", 7)
                    ->where("status", "<", 12)
                    ->orderBy("created_at", "desc")->get();
        $response = [];
        $response["data"] = $quotes;
        return response()->json($response);
    }

    /**
     * Get all Completed Quotes
     *
     * @return \Illuminate\Http\Response
     */
    public function quoteGetCompletedAll()
    {
        $quotes = QuoteRequest::where("status", 12)->orderBy("created_at", "desc")->get();
        $response = [];
        $response["data"] = $quotes;
        return response()->json($response);
    }

    /**
     * Get Submitted Quotes sent to Carrier
     *
     * @return \Illuminate\Http\Response
     */
    public function quoteGetSubmittedCarrier()
    {
        $quotes = DB::table("quote_comps")
            ->where("carrier_id", Auth::user()->id)
            ->where("status", 6)
            ->join("quote_requests", "quote_comps.quote_id", "=", "quote_requests.id")
            ->join("users", "quote_requests.customer_id", "=", "users.id")
            ->select(
                "users.*",
                "quote_comps.*",
                "quote_requests.*"
            )
            ->get();
        $response = [];
        $response["data"] = $quotes;
        return response()->json($response);
    }

    /**
     * Get Published Quotes sent to Carrier
     *
     * @return \Illuminate\Http\Response
     */
    public function quoteGetPublishedCarrier()
    {
        $quotes = DB::table("quote_comps")
            ->join("quote_requests", "quote_comps.quote_id", "=", "quote_requests.id")
            ->select(
                "quote_comps.*",
                "quote_requests.*"
            )
            ->where("carrier_id", Auth::user()->id)
            ->where("status", ">=", 7)
            ->where("status", "<=", 12)
            ->get();

        $response = [];
        $response["data"] = $quotes;
        return response()->json($response);
    }

    /**
     * Get Completed Quotes sent to Carrier
     *
     * @return \Illuminate\Http\Response
     */
    public function quoteGetCompletedCarrier()
    {
        $quotes = DB::table("quote_comps")
            ->join("quote_requests", "quote_comps.quote_id", "=", "quote_requests.id")
            ->select(
                "quote_comps.*",
                "quote_requests.*"
            )
            ->where("carrier_id", Auth::user()->id)
            ->where("status", 13)
            ->get();

        $response = [];
        $response["data"] = $quotes;
        return response()->json($response);
    }

    /**
     * Get a Requested Quote with ID.
     *
     * @return \Illuminate\Http\Response
     */
    public function quoteGetRequested($id)
    {
        $quote = DB::table("quote_requests")
            ->where("quote_requests.id", $id)
            ->join("users", "quote_requests.customer_id", "=", "users.id")
            ->select(
                "users.*",
                "quote_requests.*"
            )
            ->first();

        $equipment = QuoteDataEquipment::where("equipmentId", $quote->equipment)->get();
        $trailerSize = QuoteDataTrailerSize::where("trailerSizeId", $quote->trailerSize)->get();
        $quote->equipment_name = $equipment[0]->equipmentName . " (". $trailerSize[0]->trailerSizeName .")";
        return response()->json($quote);
    }

    /**
     * Get a Approved Quote with ID.
     *
     * @return \Illuminate\Http\Response
     */
    public function quoteGetApproved($id)
    {
        $quote = DB::table("quote_requests")
            ->where("quote_requests.id", $id)
            ->join("quote_approves", "quote_requests.id", "=", "quote_approves.quote_id")
            ->join("users", "quote_requests.customer_id", "=", "users.id")
            ->select(
                "users.*",
                "quote_requests.*",
                "quote_approves.*"
            )
            ->get();
        $equipment = QuoteDataEquipment::where("equipmentId", $quote[0]->equipment)->get();
        $trailerSize = QuoteDataTrailerSize::where("trailerSizeId", $quote[0]->trailerSize)->get();
        $quote[0]->equipment_name = $equipment[0]->equipmentName . " (". $trailerSize[0]->trailerSizeName .")";

        return response()->json($quote[0]);
    }

    /**
     * Quote Completed Create
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function quoteCompCreate(Request $request)
    {
        QuoteComp::updateOrCreate(
            ["quote_id" => $request->quote_id],
            [
                "carrier_id" => $request->carrier_id,
                "deliver_cost" => $request->deliver_cost,
                "company_carrier_comment" => $request->company_carrier_comment
            ]
        );

        $quote = DB::table("quote_comps")
            ->where("quote_comps.quote_id", $request->quote_id)
            ->leftJoin("quote_requests", "quote_comps.quote_id", "=", "quote_requests.id")
            ->join("users", "quote_comps.carrier_id", "=", "users.id")
            ->select(
                "quote_requests.*",
                "users.name as carrier_name",
                "quote_comps.*"
            )
            ->get();

        return response()->json($quote[0]);
    }

    /**
     * Rate Conf Check
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function quoteCompCheck(Request $request)
    {
        $quote = DB::table("quote_comps")
            ->where("quote_comps.quote_id", $request->quote_id)
            ->leftJoin("quote_requests", "quote_comps.quote_id", "=", "quote_requests.id")
            ->join("users", "quote_comps.carrier_id", "=", "users.id")
            ->select(
                "quote_requests.*",
                "users.name as carrier_name",
                "quote_comps.*"
            )
            ->get();

        return response()->json($quote[0]);
    }

    /**
     * Get Quote Review
     *
     * @return \Illuminate\Http\Response
     */
    public function quoteGetReview($id)
    {
        // $quote = (new Quote)->getQuote($id);
        $customer = Customer::where("quote_id", $id)->first();
        $review = QuoteComp::where("quote_id", $id)->first();

        $quote = [
            "customer_name" => $customer->first_name." ".$customer->last_name,
            "customer_review" => $review->customer_review,
            "updated_at" => $review->updated_at
        ];

        return response()->json($quote);
    }

    /*=====================================================    âœ… Page Redirections     =================================================*/
    /**
     * Create New Quote
     * Customer requests order in Frontend Service Page
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function quoteCreate(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'recaptcha',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()->withErrors($validator);
        } else {
            /* Database Quote Save */
            
            //dd($quote->countData); 
            // $quote->pickup = $request->pickup;
            // $quote->delivery = $request->delivery;
            // $quote->pickupDate = $request->pickupDate;
            // $quote->deliveryDate = $request->deliveryDate;

            $quoteService = new QuoteRequest;
            $quoteService->weight = $request->weight;
            $quoteService->temperature = $request->temperature;
            $quoteService->equipment = $request->equipment;
            $quoteService->trailerSize = $request->trailerSize;
            $quoteService->comment = $request->comment;
            $quoteService->status = 0;
            $quoteService->save();

            for($i = 1; $i < $request->countData + 1; $i++){
                $location = 'location'.$i;
                $commodity = 'commodity'.$i;
                $dimension = 'dimension'.$i;
                $dateData = 'dateData'.$i;
                $selectLoad = 'selectLoad'.$i;
                $quote = new QuoteServiceRequest;
                $quote->location = $request[$location];
                $quote->commodity = $request[$commodity];
                $quote->dimension = $request[$dimension];
                $quote->dateData = $request[$dateData];
                $quote->selectLoad = $request[$selectLoad];                
                $quote->id_alias = $quoteService->id;
                $quote->save();
            }
            
            

            /* Token Generater */
            $token = Str::random(64); 

            /* Create dedicate customer */
            $customer = new Customer;

            $customer->quote_id = $quoteService->id;
            $customer->first_name = $request->firstName;
            $customer->last_name = $request->lastName;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->verify_token = $token;
            $customer->active = false;
            $customer->save();

            /* Send Verify Email */
            $mailData = [
                'token' => $token,
                'name' => $request->firstName
            ];
            //🚫🚫🚫🚫🚫
            //Mail::to($request->email)->send(new CustomerVerify($mailData));

            QuoteRequest::where("id", $quote->id)
                ->update(["id_alias" => "QF".sprintf("%06d", $quote->id)]);

            $customer->save();

            return redirect()->route("frontend.home")
                ->withSuccess("Please verify your email.");
        };
        
    }

    /**
     * Quote Approve Create
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function quoteApprovedCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quote_id' => 'required|unique:quote_approves',
            'cost' => 'required|numeric',
            'fee' => 'required|numeric',
            'total_cost' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()->withErrors($validator);
        } else {
            /* New Quote Approve */
            $quote = new QuoteApprove;

            $quote->quote_id = $request->quote_id;
            $quote->cost = $request->cost;
            $quote->fee = $request->fee;
            $quote->total_cost = $request->total_cost;
            $quote->company_comment = $request->company_comment;

            $quote->save();

            /* Update Quote Status */
            $quoteReq = QuoteRequest::find($request->quote_id);
            $quoteReq->update(["status" => 2]);

            /* Send Email */
            $customer = Customer::where("quote_id", $quoteReq->id)->first();
            $verify_code = $customer->verify_code;
            $customer_email = $customer->email;
            $confirm_email = "piomagiera@gmail.com";

            //🚫🚫🚫🚫🚫
            //Mail::to($customer_email)->send(new CustomerQuoteCreate($verify_code, $customer_email));
            //Mail::to($confirm_email)->send(new CustomerQuoteCreate($verify_code, $customer_email));

            return redirect()->back()
                ->withSuccess("Your quote request is successfully sent to customer.");
        }
    }

    /**
     * Quote Approve Update
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function quoteApprovedRecreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quote_id' => 'required',
            'cost' => 'required|numeric',
            'fee' => 'required|numeric',
            'total_cost' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()->withErrors($validator);
        } else {
            $quote = QuoteApprove::where("quote_id", $request->quote_id)->first();

            $quote->old_cost = $quote->cost;
            $quote->old_fee = $quote->fee;
            $quote->old_total_cost = $quote->total_cost;
            $quote->old_company_comment = $quote->company_comment;
            $quote->old_reject_reason = $quote->reject_reason;

            $quote->cost = $request->cost;
            $quote->fee = $request->fee;
            $quote->total_cost = $request->total_cost;
            $quote->company_comment = $request->company_comment;
            $quote->reject_reason = "";

            $quote->save();

            QuoteRequest::Find($request->quote_id)->update(["status" => 2]);

            return redirect()->back()
                ->withSuccess("Your quote request is successfully sent to customer.");
        }
    }

    /**
     * Get Quote Information
     *
     * @return \Illuminate\Http\Response
     */
    public function quoteGetInfo()
    {
        return QuoteRequest::get()->count();
    }
}
