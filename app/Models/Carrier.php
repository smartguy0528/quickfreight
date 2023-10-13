<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Carrier extends Authenticatable
{
    /**
     * Custom login database table
     *
     */
    protected $table = 'carriers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'quote_id',
        'dot_number',
        'legal_name',
        'dba_name',
        'carrier_operation',
        'phy_street',
        'phy_city',
        'phy_state',
        'phy_zip',
        'phy_country',
        'telephone',
        'fax',
        'email_address',
        'mcs150_mileage',
        'mcs150_mileage_year',
        'mcs150_date',
        'add_date',
        'op_other',
        'verify_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'verify_code',
        'remember_token',
    ];
}
