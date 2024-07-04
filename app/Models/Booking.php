<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'state_of_residence',
        'destination_country',
        'departure_date',
        'return_date',
        'first_deposit_date',
        'total_trip_cost',
        'number_of_travelers',
        'age_of_travelers',
    ];

}
