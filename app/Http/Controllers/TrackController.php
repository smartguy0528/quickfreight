<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Track;

class TrackController extends Controller
{
    /**
     * Get Track Points of the quote
     *
     * @param $id
     * @return response
     */
    public function getTrack($id)
    {
        $quote_id = $id;

        if(Auth::guard('customerguard')->user()) {
            $quote_id = Auth::guard('customerguard')->user()->quote_id;
        };

        $points = Track::getLatLonArray($quote_id);
        return response()->json($points);
    }
}
