<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricings extends Model
{
    use HasFactory;
    protected $fillable = [
        'qty',
        'rate',
        'created_on',
        'type_id',
    ];
    public function itemtype()
    {
        return $this->belongsTo(ItemType::class, 'type_id');
    }
}
