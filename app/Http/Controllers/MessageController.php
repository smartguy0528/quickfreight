<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Message send function from someone via contact form
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function contactMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'recaptcha',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()->withErrors($validator);
        } else {
            //🚫🚫🚫🚫🚫
            // Send Email ?????????????????????????????????????????????????????????????????????????

            return redirect()->back()
                ->withSuccess('Your message submitted successfully.');
        };
    }
}
