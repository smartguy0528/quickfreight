<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Driver extends Authenticatable
{
    /**
     * Custom login database table
     *
     */
    protected $table = 'drivers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'quote_id',
        'name',
        'phone',
        'email',
        'driver_info',
        'truck_num',
        'truck_type',
        'truck_capacity',
        'miles',
        'verify_code',
        'active',
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
