<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportCharges extends Model
{
    use HasFactory;

    protected $fillable = [
        'transport_type',
        'branch',
        'qty',
        'price'
    ];
}
