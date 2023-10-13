<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\QuoteComp;
use App\Models\QuoteRequest;
use App\Models\User;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Carrier;
use App\Models\Track;
use Stevebauman\Location\Facades\Location;
use GuzzleHttp\Client;

class DriverController extends Controller
{
    /**
     * Get Location info from latitude and longitude
     *
     * @param float $latitude, float $longitude
     * @return Response
     */
    private function getLocation($lat, $lon)
    {
        // Make an HTTP request to the Nominatim API using Guzzle
        $client = new Client();
        $response = $client->get('https://nominatim.openstreetmap.org/reverse', [
            'query' => [
                'format' => 'json',
                'lat' => $lat,
                'lon' => $lon,
                'zoom' => 18,
            ],
        ]);

        // Parse the response and extract the address information
        $data = json_decode($response->getBody(), true);

        // Return the address information as string
        return $data['display_name'];

        // $address = [
        //     'road' => $data['address']['road'] ?? 'Unknown Road',
        //     'city' => $data['address']['city'] ?? 'Unknown City',
        //     'state' => $data['address']['state'] ?? 'Unknown State',
        //     'postcode' => $data['address']['postcode'] ?? 'Unknown Postcode',
        //     'country' => $data['address']['country_code'] ?? 'Unknown Country',
        // ];

        // Return the address information as string
        // return $address['road'].', '.$address['city'].' '.$address['postcode'].', '.$address['state'].', '.strtoupper($address['country']);
    }

    /**
     * Send Driver Location info to server
     *
     * @param Request $request
     * @return Response
     */
    public function sendLocation(Request $request)
    {
        $track = new Track;
        $track->quote_id = Auth::guard('driverguard')->user()->quote_id;
        $track->latitude = $request->latitude;
        $track->longitude = $request->longitude;
        $track->accuracy = $request->accuracy;
        $track->speed = $request->speed;
        $track->location = $this->getLocation($request->latitude, $request->longitude);
        $track->status = QuoteRequest::find($track->quote_id)->status;
        $track->save();

        return true;
    }

    /**
     * To Driver Main Page
     *
     * @return View
     */
    public function toDriverWelcome()
    {
        // $ip = isset($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:(isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR']);
        $location = Location::get();

        $quote_id = Auth::guard('driverguard')->user()->quote_id;
        $quoteReq = QuoteRequest::where("id", $quote_id)->first();
        $quoteComp = QuoteComp::where("quote_id", $quote_id)->first();

        $quoteComp->location = $location->cityName.' '.$location->zipCode.', '.$location->regionName.', '.$location->countryCode;
        $quoteComp->lat = $location->latitude;
        $quoteComp->long = $location->longitude;
        $quoteComp->save();

        return view("driver.welcome")
            ->with("quoteReq", $quoteReq);
    }

    /**
     * Driver Status Active
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function driverActive()
    {
        $driver = Auth::guard('driverguard')->user();
        $driver->active = true;
        $driver->save();
        return redirect()->back()
            ->withSuccess("Thanks for agree with our terms.");
    }

    /**
     * Driver Status 8 : To Pick Up
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function driverStatus8()
    {
        $driver = Auth::guard('driverguard')->user();
        $quote = QuoteRequest::find($driver->quote_id);
        $quote->status = 8;
        $quote->save();
        return redirect()->back()
            ->withSuccess("Nice, Go ahead.");
    }

    /**
     * Driver Status 9 : Loading
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function driverStatus9()
    {
        $driver = Auth::guard('driverguard')->user();
        $quote = QuoteRequest::find($driver->quote_id);
        $quote->status = 9;
        $quote->save();
        return redirect()->back()
            ->withSuccess("Good.");
    }

    /**
     * Driver Status 10 : On Delivery
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function driverStatus10()
    {
        $driver = Auth::guard('driverguard')->user();
        $quote = QuoteRequest::find($driver->quote_id);
        $quote->status = 10;
        $quote->save();
        return redirect()->back()
            ->withSuccess("Good luck your trip.");
    }

    /**
     * Driver Status 11 : Arrived
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function driverStatus11()
    {
        $driver = Auth::guard('driverguard')->user();
        $quote = QuoteRequest::find($driver->quote_id);
        $quote->status = 11;
        $quote->save();
        return redirect()->back()
            ->withSuccess("Congratulations! You made it!");
    }

    /**
     * Driver Status 12 : BOL Upload
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function driverStatus12(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bol_file' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()->withErrors($validator);
        } else {
            $quote = QuoteComp::where('quote_id', Auth::guard('driverguard')->user()->quote_id)->first();
            $file_ext = pathinfo($request->bol_file)['extension'];
            $des_path = '/bols/bol_'.$quote->quote_id.'.'.$file_ext;
            Storage::copy($request->bol_file, '/public'.$des_path);
            $quote->bol_path = $des_path;
            $quote->save();

            $driver = Auth::guard('driverguard')->user();
            $quote = QuoteRequest::find($driver->quote_id);
            $quote->status = 12;
            $quote->save();
            return redirect()->back()
                ->withSuccess("Thanks for doing with us.");
        };
    }

    /**
     * Driver Status Back
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function driverStatusBack()
    {
        $driver = Auth::guard('driverguard')->user();
        $quote = QuoteRequest::find($driver->quote_id);
        $quote->status -= 1;
        $quote->save();
        return redirect()->back();
    }
























    /**
     * To Driver Status Page
     *
     * @return View
     */
    public function toDriverStatus()
    {
        // $ip = isset($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:(isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR']);
        $location = Location::get();

        $quote_id = QuoteComp::where("driver_id", Auth::user()->id)->first()->quote_id;
        $quote = QuoteRequest::where("id", $quote_id)->first();
        $quoteComp = QuoteComp::where("quote_id", $quote_id)->first();
        $customer = User::find($quote->customer_id);
        $driver = User::find($quoteComp->driver_id);
        $carrier = User::find($quoteComp->carrier_id);

        $quoteComp->location = $location->cityName.' '.$location->zipCode.', '.$location->regionName.', '.$location->countryCode;
        $quoteComp->lat = $location->latitude;
        $quoteComp->long = $location->longitude;

        $quoteComp->save();

        return view("driver.status")
            ->with("quote", $quote)
            ->with("quote_comp", $quoteComp)
            ->with("customer", $customer)
            ->with("driver", $driver)
            ->with("carrier", $carrier);
    }

    /**
     * Driver Status Set
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function statusSet(Request $request)
    {
        QuoteRequest::find($request->id)
                    ->update([
                        "status" => $request->status
                    ]);
        return redirect()->back();
    }

    /**
     * Upload BOL
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function uploadBol(Request $request)
    {
        $request->validate([
            "bol" => "required|mimes:jpg,jpeg,png|max:2048"
        ]);
        if($request->file("bol")) {
            $idName = QuoteRequest::find($request->quote_id)->id_alias;
            $fileName = "BOL_".$idName.".".$request->file("bol")->getClientOriginalExtension();
            $filePath = $request->file("bol")->storeAs("uploads", $fileName, "public");
            QuoteRequest::where("id", $request->quote_id)
                ->update(["status" => 12]);
            QuoteComp::where("quote_id", $request->quote_id)
                ->update(["bol_path" => $filePath]);
            return redirect()->back()
                ->with("success","BOL file has been uploaded.");
        }
        return redirect()->back();
    }
}
