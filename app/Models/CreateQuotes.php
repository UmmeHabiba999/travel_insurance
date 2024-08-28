<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateQuotes extends Model
{
    use HasFactory;

    protected $table = 'create_quotes';
    protected $fillable = [
        'booking_id',
        'name',
        'quote_code',
        'price_after_discount_incl_tax',
        'premium_after_discount_excl_tax',
        'content_url',
        'consent',
        'trip_cancallation',
        'trip_interuption',
        'medical_expenses',
        'emergency_evacuation',
    ];
}
