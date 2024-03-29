<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itemtype extends Model
{
    use HasFactory;

    protected $fillable = [
        'itemtype'
    ];
    public function pricings()
    {
        return $this->hasMany(Pricings::class, 'type_id');
    }
}
