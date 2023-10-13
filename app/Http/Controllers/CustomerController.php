<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\QuoteRequest;
use App\Models\QuoteServiceRequest;
use App\Models\QuoteApprove;
use App\Models\QuoteComp;
use App\Models\QuoteDataEquipment;
use App\Models\QuoteDataTrailerSize;
use App\Models\Customer;
use App\Models\Track;
use App\Models\Driver;
use App\Models\Carrier;
use App\Mail\CustomerConfirm;
use App\Classes\VCode;
use PDF;

class CustomerController extends Controller
{
    /**
     * Customer Verify
     *
     * @param $token
     * @return Redirector
     */
    public function customerVerify($token)
    {
        $customer = Customer::where("verify_token", $token)->first();
        if(!$customer) {
            return redirect()->route("frontend.home")
                        ->withErrors(['message'=>'Verification Failed. Please recheck your email link.']);
        } else if ($customer->active) {
            return redirect()->route('frontend.home')
                        ->withSuccess("You already verified.");
        } else {
            /* Customer Active */
            $customer->active = 1;
            $customer->email_verified_at = date("Y-m-d H:i:s");
            $customer->verify_code = (new VCode)->generateCode();
            $customer->save();

            //🚫🚫🚫🚫🚫
            //Mail::to($customer->email)->send(new CustomerConfirm());

            /* Request Active */
            $quote = QuoteRequest::find($customer->quote_id);
            $quote->status = 1;

            $quote->save();

            return redirect()->route('frontend.home')
                        ->withSuccess("Your order is successfully requested.");
        }
    }

    /**
     * Customer Welcome Page
     *
     * @return View
     */
    public function customerWelcome()
    {
        $id = Auth::guard('customerguard')->user()->quote_id;
        $quoteReq = QuoteRequest::find(Auth::guard("customerguard")->user()->quote_id);
        $quoteService = QuoteServiceRequest::where("id_alias", $id)->get();
        $equipment = QuoteDataEquipment::where("equipmentId", $quoteReq->equipment)->get();
        $trailerSize = QuoteDataTrailerSize::where("trailerSizeId", $quoteReq->trailerSize)->get();
        $quoteReq->equipment_name = $equipment[0]->equipmentName . " (". $trailerSize[0]->trailerSizeName .")";
        $quoteApp = quoteApprove::where("quote_id", Auth::guard("customerguard")->user()->quote_id)->first();
        $driver = Driver::where("quote_id", Auth::guard("customerguard")->user()->quote_id)->first();
        $quoteComp = QuoteComp::where("quote_id", Auth::guard("customerguard")->user()->quote_id)->first();
        $location = Track::latest()->first();

        return view("customer.welcome")
            ->with("customer", Auth::guard("customerguard")->user())
            ->with("quoteReq", $quoteReq)
            ->with("driver", $driver)
            ->with("quoteApp", $quoteApp)
            ->with("quoteComp", $quoteComp)
            ->with("location", $location)
            ->with("quoteService", $quoteService);
    }

    /**
     * Quote Approve
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function quoteApprove(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quote_id' => 'required',
            'company_name' => 'required',
            'company_address' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with("show_modal", 1)
                ->withErrors($validator);
        } else {
            QuoteApprove::where("quote_id", $request->quote_id)
                        ->update([
                            "company_name" => $request->company_name,
                            "company_address" => $request->company_address
                        ]);

            QuoteRequest::find($request->quote_id)->update(["status" => 3]);

            return redirect()->back()
                ->withSuccess("Your request is successfully approved.");
        };
    }

    /**
     * Quote Reject
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function quoteReject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quote_id' => 'required',
            'company_name' => 'required',
            'company_address' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with("show_modal", 2)
                ->withErrors($validator);
        } else {
            QuoteApprove::where("quote_id", $request->quote_id)
                        ->update([
                            "company_name" => $request->company_name,
                            "company_address" => $request->company_address,
                            "reject_reason" => $request->reject_reason_option . " " . $request->reject_reason
                        ]);

            QuoteRequest::find($request->quote_id)->update(["status" => 4]);

            return redirect()->back()
                ->withSuccess("Your reject request is successfully sent.");
        };
    }

    /**
     * Quote Delete
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function quoteDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quote_id' => 'required',
            'delete_reason' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with("show_modal", 3)
                ->withErrors($validator);
        } else {
            $quote_approve = QuoteApprove::where("quote_id", $request->quote_id)->first();
            $quote_approve->del_reason = $request->delete_reason;
            $quote_approve->save();

            $quote_request = QuoteRequest::find($request->quote_id);
            $quote_request->status = -1;
            $quote_request->save();

            $customer = Auth::guard('customerguard')->user();
            $customer->active = 0;
            $customer->verify_code = '';
            $customer->verify_token = '';
            $customer->save();

            return redirect()->route("logout.perform")
                ->withSuccess("Thanks for interested in our service.");
        };
    }

    /**
     * Quote Review Make
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function quoteReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'review' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        } else {
            QuoteComp::where("quote_id", Auth::guard('customerguard')->user()->quote_id)->update(["customer_review" => $request->review]);

            return redirect()->back()
                ->with("success", "Congratulations! Your load transport request is successfully completed.");
        };
    }

    /**
     * Stripe Payment Page
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function customerStripe(Request $request)
    {
        $quote = QuoteApprove::where('quote_id', $request->quote_id)->first();
        $quote_id = QuoteRequest::find($request->quote_id)->id_alias;
        return view('customer.stripe')
            ->with("quote", $quote)
            ->with("quote_id", $quote_id);
    }

    /**
     * Invoice Publish to PDF
     *
     * @return PDF
     */
    public function invoicePublish()
    {
        $id = Auth::guard('customerguard')->user()->quote_id;
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
                    "pdf.customer_invoice",
                    array(
                        "quoteReq" =>  $quoteReq,
                        "quoteApp" =>  $quoteApp,
                        "customer" =>  $customer
                    ),
                )
                ->setPaper("a4", "portrait");

        return $pdf->stream();
    }

    /**
     * Invoice View to PDF
     *
     * @return View
     */
    public function invoiceView()
    {
        $id = Auth::guard('customerguard')->user()->quote_id;
        $quoteReq = QuoteRequest::find($id);
        $customer = Customer::where("quote_id", $id)->first();
        $quoteApp = QuoteApprove::where("quote_id", $id)->first();

        return view("pdf.customer_invoice")
            ->with("quoteReq", $quoteReq)
            ->with("quoteApp", $quoteApp)
            ->with("customer", $customer);
    }
}
