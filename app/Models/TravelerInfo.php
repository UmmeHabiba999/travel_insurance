<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelerInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'first_name',
        'middle_name',
        'last_name',
        'address',
        'city',
        'zip_code',
        'state_of_residence',
        'phone_number',
        'email',
        'birth_date',
        'age',
    ];
}
