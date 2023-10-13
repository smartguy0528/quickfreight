<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuoteRequest;
use App\Models\QuoteApprove;
use App\Models\QuoteComp;
// use App\Models\Order;
use App\Classes\Paypal;

class PaypalController extends Controller
{
    /**
     * @param Request $request
     */
    public function form(Request $request)
    {
        $order = Order::find(mt_rand(1, 30));

        // the above order is just for example.

        return view('form', compact('order'));
    }
    /**
     * @param $order_id
     * @param Request $request
     */
    public function checkout($order_id, Request $request)
    {
        $quote_id = decrypt($order_id);
        $quoteReq = QuoteRequest::find($quote_id);
        $quoteApp = QuoteApprove::where('quote_id', $quote_id)->first();

        $paypal = new Paypal;

        $response = $paypal->purchase([
            'amount' => $paypal->formatAmount($quoteApp->total_cost),
            'transactionId' => $quoteReq->id_alias,
            'currency' => 'USD',
            'cancelUrl' => $paypal->getCancelUrl($quoteReq),
            'returnUrl' => $paypal->getReturnUrl($quoteReq),
        ]);

        if ($response->isRedirect()) {
            $response->redirect();
        }

        return redirect()->back()->with([
            'message' => $response->getMessage(),
        ]);
    }

    /**
     * @param $order_id
     * @param Request $request
     * @return mixed
     */
    public function completed($order_id, Request $request)
    {
        $quoteReq = QuoteRequest::find($order_id);
        $quoteApp = QuoteApprove::where('quote_id', $order_id)->first();

        $paypal = new Paypal;

        $response = $paypal->complete([
            'amount' => $paypal->formatAmount($quoteApp->total_cost),
            'transactionId' => $quoteReq->id_alias,
            'currency' => 'USD',
            'cancelUrl' => $paypal->getCancelUrl($quoteReq),
            'returnUrl' => $paypal->getReturnUrl($quoteReq),
            'notifyUrl' => $paypal->getNotifyUrl($quoteReq),
        ]);

        if ($response->isSuccessful()) {
            QuoteRequest::find($order_id)
                ->update([
                    'transaction_id' => $response->getTransactionReference(),
                    'payment_status' => QuoteRequest::PAYMENT_COMPLETED,
                    'status' => 13
                ]);

            return redirect()->route('customer.welcome')->with([
                'message' => 'You recent payment is sucessful with reference code ' . $response->getTransactionReference(),
            ]);
        }

        return redirect()->back()->with([
            'message' => $response->getMessage(),
        ]);
    }

    /**
     * @param $order_id
     */
    public function cancelled($order_id)
    {
        $order = QuoteRequest::find($order_id);

        return redirect()->route('customer.welcome')->with([
            'message' => 'You have cancelled your recent PayPal payment !',
        ]);
    }

    /**
     * @param $order_id
     * @param $env
     * @param Request $request
     */
    public function webhook($order_id, $env, Request $request)
    {
        // to do with new release of sudiptpa/paypal-ipn v3.0 (under development)
    }
}
