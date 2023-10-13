<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;

/**
 * Class Quote
 */
class Quote {
    /**
     * Get full quote with id
     *
     */
    public function getQuote($id) {
        $quote = DB::table("quote_requests")
                ->where("quote_requests.id", $id)
                ->join("quote_approves", "quote_approves.quote_id", "quote_requests.id")
                ->join("quote_comps", "quote_comps.quote_id", "quote_requests.id")
                ->join("quote_data_equipment", "quote_data_equipment.equipmentId", "quote_requests.equipment")
                ->join("quote_data_trailer_sizes", "quote_data_trailer_sizes.trailerSizeId", "quote_requests.trailerSize")
                ->join("customers", "customers.quote_id", "quote_requests.id")
                ->join("carriers", "carriers.quote_id", "quote_requests.id")
                ->join("drivers", "drivers.quote_id", "quote_requests.id")
                ->select(
                    "customers.first_name as customer_name",
                    "customers.email as customer_email",
                    "customers.phone as customer_phone",
                    "carriers.legal_name as carrier_name",
                    "carriers.email_address as carrier_email",
                    "carriers.telephone as carrier_phone",
                    "drivers.name as driver_name",
                    "drivers.email as driver_email",
                    "drivers.phone as driver_phone",
                    "drivers.truck_num as truck_num",
                    "drivers.truck_type as truck_type",
                    "drivers.truck_capacity as truck_capacity",
                    "drivers.miles as miles",
                    "quote_data_equipment.equipmentName as equipment_name",
                    "quote_data_trailer_sizes.trailerSizeName as trailer_size",
                    "quote_approves.*", "quote_comps.*", "quote_requests.*"
                )
                ->get();

        if (count($quote)) {
            return $quote[0];
        } else {
            return false;
        };
    }

    /**
     * Get company requested quote with id
     *
     */
    public function getRequestedQuote($id) {
        $quote = DB::table("quote_requests")
                ->where("quote_requests.id", $id)
                ->join("quote_approves", "quote_approves.quote_id", "quote_requests.id")
                ->join("quote_comps", "quote_comps.quote_id", "quote_requests.id")
                ->join("quote_data_equipment", "quote_data_equipment.equipmentId", "quote_requests.equipment")
                ->join("quote_data_trailer_sizes", "quote_data_trailer_sizes.trailerSizeId", "quote_requests.trailerSize")
                ->join("users as customers", "customers.id", "quote_requests.customer_id")
                ->join("users as carriers", "carriers.id", "quote_comps.carrier_id")
                ->select(
                    "customers.name as customer_name",
                    "customers.email as customer_email",
                    "customers.phone as customer_phone",
                    "carriers.name as carrier_name",
                    "carriers.email as carrier_email",
                    "carriers.phone as carrier_phone",
                    "quote_data_equipment.equipmentName as equipment_name",
                    "quote_data_trailer_sizes.trailerSizeName as trailer_size",
                    "quote_approves.*", "quote_comps.*", "quote_requests.*"
                )
                ->get();

        if (count($quote)) {
            return $quote[0];
        } else {
            return false;
        };
    }
};
