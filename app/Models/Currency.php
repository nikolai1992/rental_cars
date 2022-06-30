<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    //
    protected $guarded = [];

    public static function CurrencyConverter($price, $dollar_rate)
    {
        return round($price/$dollar_rate, 2);
    }
}
