<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuoteRequest;
use App\Models\QuoteApprove;
use App\Models\Customer;
use App\Models\Carrier;
use App\Models\Driver;
use App\Models\Track;
use Session;
use Stripe;

class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    // public function stripe()
    // {
    //     return view('stripe');
    // }

    /**
     * success response method.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $cost = QuoteApprove::where('quote_id', $request->id)->first()->total_cost;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => $cost * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment of Quick Freight Enterprise Inc. Quote ID ".$request->id,
        ]);

        // Status Update
        $quote = QuoteRequest::find($request->id);
        $quote->status = 13;
        $quote->payment_status = 2;
        $quote->transaction_id = $request->stripeToken;
        $quote->save();

        // Initialize Customer, Carrier, Driver Credentials
        Customer::where("quote_id", $request->id)->update(["verify_token" => ""]);
        Carrier::where("quote_id", $request->id)->update(["verify_code" => ""]);
        Driver::where("quote_id", $request->id)->update(["verify_code" => ""]);
        Track::where("quote_id", $request->id)->delete();


        return redirect()->route('customer.welcome')
            ->withSuccess("Payment is successfully progressed.");
    }
}
