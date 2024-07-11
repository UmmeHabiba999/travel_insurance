<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'card_number',
        'expiration_date',
        'cvc',
        'payment_address',
        'payment_city',
        'payment_zip_code',
        'payment_country',
        'payment_state_of_residence',
        'billing_address',
        'promotional_info',
        'terms_conditions',

    ];
}
