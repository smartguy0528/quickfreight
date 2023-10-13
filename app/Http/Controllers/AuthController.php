<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Carrier;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\QuoteRequest;

class AuthController extends Controller
{
    /**
     * Handle account login request
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
        // dd($credentials);

        if(!Auth::validate($credentials)):
            return redirect()->to('/login')
                // ->withErrors(trans('auth.failed'));
                ->withErrors(['message' => trans('auth.failed')]);
            endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::guard('web')->login($user);

        return $this->authenticated($user);
    }

    /**
     * Handle response after user authenticated
     *
     * @param Auth $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated($user)
    {
        if (!$user->role) {
            return redirect()->intended('/admin');
        } else if ($user->role == 1) {
            return redirect()->intended('/manager');
        };
    }

    /**
     * Handle customer login request
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function loginCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'verify_code' => 'required|numeric|digits:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()->withErrors($validator);
        } else {
            $customers = Customer::where('email', $request->email)->get();

            if (count($customers)) {
                $customer_auth = Customer::where('email', $request->email)
                                    ->where('verify_code', $request->verify_code)
                                    ->where('active', 1)
                                    ->first();

                if($customer_auth) {
                    Auth::guard('customerguard')->loginUsingId($customer_auth->id, true);
                    return redirect()->route('customer.welcome');
                } else {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['message' => 'Invalid Verify Code.']);
                }
            } else {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['message' => 'There is no exist customer with the email.']);
            };
        }
    }

    /**
     * Handle Carrier login request
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function loginCarrier(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dot_number' => 'required|numeric',
            'verify_code' => 'required|numeric|digits:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()->withErrors($validator);
        } else {
            $carrier = Carrier::where('dot_number', $request->dot_number)
                            ->where('verify_code', $request->verify_code)
                            ->first();
            if ($carrier) {
                Auth::guard('carrierguard')->loginUsingId($carrier->id);
                return redirect()->route('carrier.welcome')
                    ->withSuccess("Authenticated.");
            } else {
                return redirect()->route('login.carrier')
                    ->withInput()->withErrors(["message" => "Invalid DOT Number or Verify Code."]);
            };
        };
    }

    /**
     * Handle Driver login request
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function loginDriver(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'verify_code' => 'required|numeric|digits:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()->withErrors($validator);
        } else {
            $driver = Driver::where('email', $request->email)
                            ->where('verify_code', $request->verify_code)
                            ->first();
            if ($driver) {
                Auth::guard('driverguard')->loginUsingId($driver->id);
                return redirect()->route('driver.welcome')
                    ->withSuccess("Authenticated.");
            } else {
                return redirect()->route('login.driver')
                    ->withInput()->withErrors(["message" => "Invalid Email or Verify Code."]);
            };
        };
    }

    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();
        Auth::guard('customerguard')->logout();
        Auth::guard('carrierguard')->logout();
        Auth::guard('driverguard')->logout();

        return redirect()->route('frontend.home');
    }
}
