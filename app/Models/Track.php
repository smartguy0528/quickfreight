<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    // Define a new method to get lat and lon data as array of arrays
    public static function getLatLonArray($id)
    {
        $locations = self::where('quote_id', $id)->get();
        $latLonArray = [];

        foreach ($locations as $location) {
            $latLonArray[] = [
                'lat' => $location->latitude,
                'lng' => $location->longitude
            ];
        }

        return $latLonArray;
    }
}
