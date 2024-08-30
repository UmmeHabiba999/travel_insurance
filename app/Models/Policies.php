<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policies extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_id',
        'quote_code',
        'price_after_discount_inc_tax',
        'currency',
        'policy_holder_name',
        'policy_holder_email',
        'birth_date',
        'address',
        'consent_code',
        'is_payment_successful',
    ];
}
