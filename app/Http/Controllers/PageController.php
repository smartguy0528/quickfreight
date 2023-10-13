<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\QuoteDataEquipment;
use App\Models\QuoteDataTrailerSize;


class PageController extends Controller
{
    /**
     * To Landing Page
     *
     * @return view
     */
    public function toLandingPage()
    {
        if (Auth::user()) {
            if (!Auth::user()->role) {
                return redirect()->route('admin.users');
            } else if (Auth::user()->role == 1) {
                return redirect()->route('manager.dashboard');
            } else if (Auth::user()->role == 2) {
                return redirect()->route('customer.welcome');
            } else if (Auth::user()->role == 3) {
                return redirect()->route('carrier.quotes');
            } else if (Auth::user()->role == 4) {
                return redirect()->route('driver.status');
            }
        } else if (Auth::guard('customerguard')->check()) {
            return redirect()->route('customer.welcome');
        } else if (Auth::guard('carrierguard')->check()) {
            return redirect()->route('carrier.welcome');
        } else if (Auth::guard('driverguard')->check()) {
            return redirect()->route('driver.welcome');
        } else {
            // $reviews = DB::table('quote_comps')
            //     ->where('disp_review', 1)
            //     ->join('quote_requests', 'quote_comps.quote_id', '=', 'quote_requests.id')
            //     ->join('users', 'quote_requests.customer_id', '=', 'users.id')
            //     ->select(
            //         'quote_comps.customer_review',
            //         'quote_comps.star_review',
            //         'users.name'
            //     )
            //     ->get();
            $reviews = [];
            
            /*$response = Http::get("https://mobile.fmcsa.dot.gov/qc/services/carriers/100775?webKey=b123209abd2cc9e9bef68695ce01d7f5adfe0213");
            $carrier_info = $response->json();
            dd($carrier_info);*/
            
            return view("frontend.home")
                ->with("reviews", $reviews);
        }
    }

    /**
     * To Services Page
     *
     * @return view
     */
    public function toServicesPage()
    {
        $equipments = QuoteDataEquipment::all();
        $trailer_size = QuoteDataTrailerSize::all();
        return view("frontend.services")
            ->with("equipments", $equipments)
            ->with("trailer_size", $trailer_size);
    }

    /**
     * To About Us Page
     *
     * @return view
     */
    public function toAboutPage()
    {
        return view("frontend.about");
    }

    /**
     * To Contact Us Page
     *
     * @return view
     */
    public function toContactPage()
    {
        return view("frontend.contact");
    }

    /**
     * To Privacy Policy Page
     *
     * @return view
     */
    public function toPrivacyPage()
    {
        return view("frontend.privacy");
    }

    /**
     * To Login Page
     *
     * @return view
     */
    public function toLoginPage()
    {
        return view("auth.login");
    }

    /**
     * To Customer Login Page
     *
     * @return view
     */
    public function toLoginCustomerPage()
    {
        return view("auth.login_customer");
    }

    /**
     * To Carrier Login Page
     *
     * @return view
     */
    public function toLoginCarrierPage()
    {
        return view("auth.login_carrier");
    }

    /**
     * To Driver Login Page
     *
     * @return view
     */
    public function toLoginDriverPage()
    {
        return view("auth.login_driver");
    }
}
