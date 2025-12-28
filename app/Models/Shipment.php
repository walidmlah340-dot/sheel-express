<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'customer_id',
        'pickup_address',
        'dropoff_address',
        'package_desc',
        'weight',
        'cod_amount',
        'status',
    ];
}

