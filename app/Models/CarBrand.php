<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    //
    protected $guarded = [];

    public function cars()
    {
        return $this->hasMany(Car::class, 'brand_id', 'id');
    }

    public static function findInArr($arr, $value)
    {
        if ($arr) {
            foreach ($arr as $a) {
                if ($a==$value) {
                    return "selected";
                }
            }
        }
        return '';
    }

    public function getCountCarsWithSimpleRent()
    {
        return $this->cars()->where('saved', true)->whereHas('simpleRent')->whereHas('images')->get();
    }
}
