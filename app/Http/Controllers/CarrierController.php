<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
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
use PDF;
use Twilio\Rest\Client;
use App\Mail\DriverQuote;
use App\Classes\Quote;
use App\Classes\VCode;


class CarrierController extends Controller
{
    /*========================================================    ✅ APIs     =================================================*/
    /**
     * Get all Carriers
     *
     * @return \Illuminate\Http\Response
     */
    public function getCarriers()
    {
        $carriers = User::where("role", 3)->get();
        $response = [];
        $response["data"] = $carriers;
        return response()->json($response);
    }

    /**
     * Get a Carrier with ID.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCarrier($id)
    {
        $carrier = User::find($id);

        return response()->json($carrier);
    }

    /**
     * Create or Update Carrier
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function carrierSave(Request $request)
    {
        if ($request->id) {
            $carrier = User::find($request->id);
        } else {
            $carrier = new User;
        };

        $carrier->role = 3;
        $carrier->name = $request->name;
        $carrier->email = $request->email;
        $carrier->phone = $request->phone;
        $carrier->address = $request->address;
        $carrier->information = $request->information;

        $carrier->save();

        return response()->json(["success"=>"Carrier information successfully saved."]);
    }

    /**
     * Delete Carrier Data
     *
     * @return \Illuminate\Http\Response
     */
    public function CarrierDelete($id)
    {
        User::find($id)->delete();

        return response()->json(["success"=>"Carrier account successfully deleted."]);
    }


    /*========================================================    ✅ REDIRECTS     =================================================*/
    /**
     * To Carrier Welcome Page
     *
     * @return View
     */
    public function toCarrierWelcome()
    {
        $quote_id = Auth::guard('carrierguard')->user()->quote_id;
        $quoteReq = QuoteRequest::find($quote_id);

        if(!$quoteReq) {
            return view("carrier.quote_none")
                ->withErrors(["message" => "There is no quote exist."]);
        } else if ($quoteReq->status < 5) {
            return redirect()->route('logout.perform')
                ->withErrors(["message" =>"You have no permission to access this request."]);
        };

        $customer = Customer::where("quote_id", $quote_id)->first();
        $equipment = QuoteDataEquipment::where("equipmentId", $quoteReq->equipment)->get();
        $trailerSize = QuoteDataTrailerSize::where("trailerSizeId", $quoteReq->trailerSize)->get();
        $quoteReq->equipment_name = $equipment[0]->equipmentName . " (". $trailerSize[0]->trailerSizeName .")";
        $quoteApp = QuoteApprove::where("quote_id", $quote_id)->first();

        $quoteComp = QuoteComp::where("quote_id", $quote_id)->first();
        $driver = Driver::where("quote_id", $quote_id)->first();

        return view("carrier.welcome")
            ->with("customer", $customer)
            ->with("quoteReq", $quoteReq)
            ->with("quoteApp", $quoteApp)
            ->with("quoteComp", $quoteComp)
            ->with("driver", $driver);
    }

    /**
     * To Carrier Next Step
     *
     * @return Redirector
     */
    public function toCarrierStep2()
    {
        return redirect()->back()
            ->withSuccess("Request confirmed.")
            ->with("state", 2);
    }

    /**
     * To Carrier Next Step
     *
     * @return Redirector
     */
    public function toCarrierStep3()
    {
        return redirect()->back()
            ->withSuccess("Request confirmed.")
            ->with("state", 3);
    }

    /**
     * To Carrier Next Step
     *
     * @param Request $request
     * @return Redirector
     */
    public function toCarrierStep3_with_phone(Request $request)
    {
        Validator::extend('phone_number', function ($attribute, $value, $parameters, $validator) {
            // Validate the phone number format
            return preg_match('/^\d{3}-\d{3}-\d{4}$/', $value);
        });

        Validator::replacer('phone_number', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The driver phone field must be a phone number in the format 123-456-7890.');
        });

        $validator = Validator::make($request->all(), [
            'driver_name' => 'required',
            'driver_phone' => 'required|phone_number',
            'truck_num' => 'required',
            'driver_email' => 'required|email',
            'miles' => 'required',
            'truck_type' => 'required',
            'truck_capacity' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with("state", 2)
                ->withErrors($validator);
        } else {
            /* Check phone number is validate */
            $sid = env('TWILIO_ACCOUNT_SID');
            $token = env('TWILIO_AUTH_TOKEN');

            $client = new Client($sid, $token);

            try {
                $lookup = $client->lookups->v1->phoneNumbers("+1" . str_replace('-', '', $request->driver_phone))
                            ->fetch(array("type" => "carrier"));
                if ($lookup->carrier['type'] == 'mobile') {
                    $driver = Driver::updateOrCreate(
                        ["quote_id" => Auth::guard('carrierguard')->user()->quote_id],
                        [
                            "name" => $request->driver_name,
                            "phone" => $request->driver_phone,
                            "email" => $request->driver_email,
                            "miles" => $request->miles,
                            "truck_num" => $request->truck_num,
                            "truck_type" => $request->truck_type,
                            "truck_capacity" => $request->truck_capacity,
                            "driver_info" => $request->driver_info,
                            "verify_code" => (new VCode)->generateCode()
                        ]
                    );

                    return redirect()->back()
                        ->withSuccess("Driver assigned.")
                        ->with("state", 3);
                } else if ($lookup->carrier['type'] == 'landline') {
                    return redirect()->back()
                        ->withInput()
                        ->with("state", 2)
                        ->withErrors(["driver_phone" => "Phone Number should be Mobile Phone Number."]);
                } else {
                    return redirect()->back()
                        ->withInput()
                        ->with("state", 2)
                        ->withErrors(["driver_phone" => "There is no exist such phone number."]);
                };
            } catch (\Exception $e) {
                return redirect()->back()
                        ->withInput()
                        ->with("state", 2)
                        ->withErrors(["driver_phone" => "Phone number Error."]);
            }

        };
    }

    /**
     * To Carrier Next Step
     *
     * @param Request $request
     * @return Redirector
     */
    public function toCarrierStep4(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doc_carrier_packet' => 'required',
            'doc_cert_ins' => 'required',
            'doc_w9_form' => 'required',
            'doc_operating_auth' => 'required',
            'carrier_sign' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with("state", 3)
                ->withErrors($validator);
        } else {

            $quote = QuoteComp::where('quote_id', Auth::guard('carrierguard')->user()->quote_id)->first();

            Storage::move($request->doc_carrier_packet, '/public/documents/'.$quote->quote_id.'_doc_carrier_packet.pdf');
            Storage::move($request->doc_cert_ins, '/public/documents/'.$quote->quote_id.'_doc_cert_ins.pdf');
            Storage::move($request->doc_w9_form, '/public/documents/'.$quote->quote_id.'_doc_w9_form.pdf');
            Storage::move($request->doc_operating_auth, '/public/documents/'.$quote->quote_id.'_doc_operating_auth.pdf');

            $quote->doc_carrier_packet = '/documents/'.$quote->quote_id.'_doc_carrier_packet.pdf';
            $quote->doc_cert_ins = '/documents/'.$quote->quote_id.'_doc_cert_ins.pdf';
            $quote->doc_w9_form = '/documents/'.$quote->quote_id.'_doc_w9_form.pdf';
            $quote->doc_operating_auth = '/documents/'.$quote->quote_id.'_doc_operating_auth.pdf';
            $quote->carrier_sign = $request->carrier_sign;
            $quote->save();

            $quote_req = QuoteRequest::find(Auth::guard('carrierguard')->user()->quote_id);
            $quote_req->status = 6;
            $quote_req->save();

            return redirect()->back()
                ->withSuccess("Conguratulations! You finished confirmation.");

        };
    }

    /**
     * To Carrier Next Step
     *
     * @param Request $request
     * @return Redirector
     */
    public function toCarrierStep5(Request $request)
    {
        Validator::extend('phone_number', function ($attribute, $value, $parameters, $validator) {
            // Validate the phone number format
            return preg_match('/^\d{3}-\d{3}-\d{4}$/', $value);
        });

        Validator::replacer('phone_number', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The driver phone field must be a phone number in the format 123-456-7890.');
        });

        $validator = Validator::make($request->all(), [
            'driver_name' => 'required',
            'driver_phone' => 'required|phone_number',
            'truck_num' => 'required',
            'driver_email' => 'required|email',
            'miles' => 'required',
            'truck_type' => 'required',
            'truck_capacity' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        } else {
            /* Check phone number is validate */
            $sid = env('TWILIO_ACCOUNT_SID');
            $token = env('TWILIO_AUTH_TOKEN');

            $client = new Client($sid, $token);

            try {
                $lookup = $client->lookups->v1->phoneNumbers("+1" . str_replace('-', '', $request->driver_phone))
                            ->fetch(array("type" => "carrier"));
                if ($lookup->carrier['type'] == 'mobile') {
                    $driver = Driver::updateOrCreate(
                        ["quote_id" => Auth::guard('carrierguard')->user()->quote_id],
                        [
                            "name" => $request->driver_name,
                            "phone" => $request->driver_phone,
                            "email" => $request->driver_email,
                            "miles" => $request->miles,
                            "truck_num" => $request->truck_num,
                            "truck_type" => $request->truck_type,
                            "truck_capacity" => $request->truck_capacity,
                            "driver_info" => $request->driver_info,
                            "verify_code" => (new VCode)->generateCode()
                        ]
                    );

                    /* Driver Info */
                    $verify_code = $driver->verify_code;
                    $driver_email = $driver->email;
                    $driver_name = $driver->name;

                    /* Driver Send SMS */
                    $accountSid = env('TWILIO_ACCOUNT_SID');
                    $authToken = env('TWILIO_AUTH_TOKEN');
                    $twilioNumber = env('TWILIO_FROM');

                    $client = new Client($accountSid, $authToken);

                    //🚫🚫🚫🚫🚫 Change Driver phone - $driver->phone vs '785-879-4645'(Joe), '786-247-7665'(Fernando)
                    /*$message = $client->messages->create(
                        "+1" . str_replace('-', '', '786-247-7665'),
                        [
                            'from' => $twilioNumber,
                            'body' => "* Driver Phone Number is ".$driver->phone.", but message was sent to you for test."
                                        ."\r\n Driver Email: ".$driver_email
                                        ."\r\n Verify code: ".$verify_code
                                        ."\r\n https://www.quickfreightenterprise.com/login/driver",
                        ]
                    );*/

                    //if ($message->sid) {
                    if (true) {
                        /* Driver Email Code */
                        //🚫🚫🚫🚫🚫
                        //Mail::to($driver_email)->send(new DriverQuote($verify_code, $driver_email, $driver_name));

                        $quote_req = QuoteRequest::find(Auth::guard('carrierguard')->user()->quote_id);
                        $quote_req->status = 8;
                        $quote_req->save();

                        return redirect()->back()
                            ->withSuccess("Driver assigned.");

                    } else {
                        return redirect()->back()
                            ->withInput()
                            ->withErrors(["message" => "Cannot send SMS to Driver. Check again the driver phone number."]);
                    };

                } else if ($lookup->carrier['type'] == 'landline') {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(["driver_phone" => "Phone Number should be Mobile Phone Number."]);
                } else {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(["driver_phone" => "There is no exist such phone number."]);
                };
            } catch (\Exception $e) {
                return redirect()->back()
                        ->withInput()
                        ->withErrors(["driver_phone" => "Phone number Error."]);
            }

        };
    }

    /**
     * To Carrier Step Back
     *
     * @return Redirector
     */
    public function toCarrierStepBack($state)
    {
        return redirect()->back()
            ->with("state", $state);
    }


    /**
     * To Carrier QuoteCheck Page
     *
     * @return Redirctor
     */
    public function toCarrierQuoteReject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reject_reason' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with("modal", 1)
                ->withErrors($validator);
        } else {
            $quote = QuoteRequest::find(Auth::guard('carrierguard')->user()->quote_id);
            $quote->status = 3;
            $quote->save();

            $carrier = Auth::guard('carrierguard')->user();
            $carrier->verify_code = '';
            $carrier->save();

            return redirect()->route("logout.perform")
                    ->with(["message" => "You rejected the request."]);
        };
    }










    /**
     * To Carrier QuoteCheck Page
     *
     * @return View
     */
    public function toCarrierQuotes()
    {
        $quotes = DB::table("quote_requests")
            ->join("users", "quote_requests.customer_id", "=", "users.id")
            ->join("quote_comps", "quote_requests.id", "=", "quote_comps.quote_id")
            ->select(
                "users.name",
                "quote_comps.created_at as requested_time",
                "quote_requests.*",
            )
            ->where("quote_requests.status", 6)
            ->where("quote_comps.carrier_id", Auth::guard('carrierguard')->user()->id)
            ->get();
        return view("carrier.quotes")
            ->with("quotes", $quotes);
    }

    /**
     * To Carrier Published Quote Page
     *
     * @return View
     */
    public function toCarrierPublishedQuotes()
    {
        $quotes = DB::table("quote_requests")
            ->join("users", "quote_requests.customer_id", "=", "users.id")
            ->join("quote_comps", "quote_requests.id", "=", "quote_comps.quote_id")
            ->join("status_descriptions", "quote_requests.status", "=", "status_descriptions.status_id")
            ->select(
                "users.name",
                "status_descriptions.title as status_description",
                "quote_comps.created_at as requested_time",
                "quote_requests.*",
            )
            ->where("quote_requests.status", ">=", 7)
            ->where("quote_requests.status", "<", 12)
            ->where("quote_comps.carrier_id", Auth::guard('carrierguard')->user()->id)
            ->get();
        return view("carrier.quotes_published")
            ->with("quotes", $quotes);
    }

    /**
     * To Carrier Completed Quote Page
     *
     * @return View
     */
    public function toCarrierCompletedQuotes()
    {
        $quotes = DB::table("quote_requests")
            ->join("users", "quote_requests.customer_id", "=", "users.id")
            ->join("quote_comps", "quote_requests.id", "=", "quote_comps.quote_id")
            ->select(
                "users.name",
                "quote_comps.created_at as requested_time",
                "quote_requests.*",
            )
            ->where("quote_requests.status", 12)
            ->where("quote_comps.carrier_id", Auth::guard('carrierguard')->user()->id)
            ->get();
        return view("carrier.quotes_completed")
            ->with("quotes", $quotes);
    }

    /**
     * To Carrier Quote Detail Page
     *
     * @param Request $id
     * @return View
     */
    public function toCarrierQuoteDetails($id)
    {
        $quoteReq = QuoteRequest::find($id);
        $equipment = QuoteDataEquipment::where("equipmentId", $quoteReq->equipment)->get();
        $trailerSize = QuoteDataTrailerSize::where("trailerSizeId", $quoteReq->trailerSize)->get();
        $quoteReq->equipment_name = $equipment[0]->equipmentName . " (". $trailerSize[0]->trailerSizeName .")";
        $quoteReq->customer_name = User::find($quoteReq->customer_id)->name;
        $quoteApp = QuoteApprove::where("quote_id", $id)->first();
        $quoteComp = QuoteComp::where("quote_id", $id)->first();
        $driver = User::find($quoteComp->driver_id);

        if ($quoteReq->status >= 6 && $quoteComp->carrier_id == Auth::guard('carrierguard')->user()->id) {
            return view("carrier.quote_details")
                ->with("quoteReq", $quoteReq)
                ->with("quoteApp", $quoteApp)
                ->with("quoteComp", $quoteComp)
                ->with("driver", $driver);
        } else {
            return abort(404);
        }
    }

    /**
     * Quote Publish
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function quotePublish(Request $request)
    {
        // ==================   Update =======================
        $driver = User::updateOrCreate(
            ["email" => $request->driverEmail],
            [
                "name" => $request->driverName,
                "phone" => $request->driverPhone,
                "role" => 4,
                "verify_code" => (new VCode)->generateCode()
            ]
        );

        $carrier_id = QuoteComp::where("quote_id", $request->quoteID)->first()->carrier_id;
        $location = User::find($carrier_id)->address;

        QuoteComp::where("quote_id", $request->quoteID)
                    ->update([
                        "driver_id" => $driver->id,
                        "truck_num" => $request->truckNumber,
                        "truck_type" => $request->truckType,
                        "truck_capacity" => $request->truckCapacity,
                        "miles" => $request->miles,
                        "carrier_comment" => $request->description,
                        "carrier_sign" => $request->carrierSign,
                        "location" => $location
                    ]);

        QuoteRequest::Find($request->quoteID)->update(["status" => 7]);

        /* Email verify code */
        $verify_code = $driver->verify_code;
        $driver_email = $request->driverEmail;
        $driver_name = $request->driverName;

        //🚫🚫🚫🚫🚫
        //Mail::to($driver_email)->send(new DriverQuote($verify_code, $driver_email, $driver_name));

        return redirect()->back()
            ->with("success", "Rate Conf successfully sent.");

    }

    /**
     * Rate Conf Publish to PDF
     *
     * @return View
     */
    public function confPublish($id)
    {
        $quoteReq = QuoteRequest::find($id);
        $equipment = QuoteDataEquipment::where("equipmentId", $quoteReq->equipment)->first();
        $trailerSize = QuoteDataTrailerSize::where("trailerSizeId", $quoteReq->trailerSize)->first();
        $quoteReq->equipment_name = $equipment->equipmentName . " (". $trailerSize->trailerSizeName .")";
        $customer = Customer::where("quote_id", $id)->first();
        $quoteReq->customer_name = $customer->first_name . " " . $customer->last_name;
        $quoteApp = QuoteApprove::where("quote_id", $id)->first();
        $quoteComp = QuoteComp::where("quote_id", $id)->first();
        $driver = Driver::where("quote_id", $id)->first();
        $carrier = Carrier::where("quote_id", $id)->first();

        $pdf = PDF::loadView(
                    "pdf.rateconf_carrier",
                    array(
                        "quoteReq" =>  $quoteReq,
                        "quoteApp" =>  $quoteApp,
                        "quoteComp" =>  $quoteComp,
                        "carrier" =>  $carrier,
                        "driver" =>  $driver,
                    ),
                )
                ->setPaper("a4", "portrait");

        return $pdf->stream();
    }

    /**
     * Rate Conf View
     *
     * @return View
     */
    public function confView($id)
    {
        $quoteReq = QuoteRequest::find($id);
        $quoteService = QuoteServiceRequest::where("id_alias", $id)->get();
        $equipment = QuoteDataEquipment::where("equipmentId", $quoteReq->equipment)->first();
        $trailerSize = QuoteDataTrailerSize::where("trailerSizeId", $quoteReq->trailerSize)->first();
        $quoteReq->equipment_name = $equipment->equipmentName . " (". $trailerSize->trailerSizeName .")";
        $customer = Customer::where("quote_id", $id)->first();
        $quoteReq->customer_name = $customer->first_name . " " . $customer->last_name;
        $quoteApp = QuoteApprove::where("quote_id", $id)->first();
        $quoteComp = QuoteComp::where("quote_id", $id)->first();
        $driver = Driver::where("quote_id", $id)->first();
        $carrier = Carrier::where("quote_id", $id)->first();

        return view("pdf.rateconf_carrier")
            ->with("quoteReq", $quoteReq)
            ->witht("quoteService", $quoteService)
            ->with("quoteApp", $quoteApp)
            ->with("quoteComp", $quoteComp)
            ->with("carrier",  $carrier)
            ->with("driver", $driver);
    }
}
