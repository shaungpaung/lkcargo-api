<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'nrc',
        'phone',
        'phone_number',
        'address',
        'business_name',
        'payment_type'
    ];
}
