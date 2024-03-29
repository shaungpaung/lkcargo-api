<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Othercharges extends Model
{
    use HasFactory;

    protected $fillable = [
        'charge_type',
        'qty',
        'rate'
    ];
}
