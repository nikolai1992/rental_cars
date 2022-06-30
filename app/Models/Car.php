<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Car extends Model
{
    //
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(CarImage::class, 'car_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'car_id', 'id');
    }

    public function simpleRent()
    {
        return $this->belongsTo('App\Models\Rent','id', 'car_id');
    }

    public function carBrand()
    {
        return $this->belongsTo('App\Models\CarBrand','brand_id', 'id');
    }

    public function partner()
    {
        return $this->belongsTo('App\Models\User','user_id', 'id');
    }

    public function getPriceFromPercentVat($price_day_1, $vat_tax)
    {
        $one_percent = $price_day_1/100;
        $vat_tax_price = round($one_percent*$vat_tax, 2);
        return $vat_tax_price;
    }

    public function driverRent()
    {
        return $this->belongsTo('App\Models\DriverRent','id', 'car_id');
    }

    public function getTotalRentalCount()
    {
        if($this->rent_type=="simple_rent")
        {

            return count($this->simpleApprovedRentOrders()->where('status', 'approved')->get());
        }elseif($this->rent_type=="with_driver")
        {
            return count($this->approvedRentWithDriverOrders()->where('status', 'approved')->get());
        }
    }

    public function getTotalBookedPrice()
    {
        $price = 0;
        if($this->rent_type=="simple_rent")
        {
            $orders = $this->simpleApprovedRentOrders()->where('status', 'approved')->get();
            foreach($orders as $order)
            {
                $price+=$order->total_price;
            }
        }elseif($this->rent_type=="with_driver")
        {
            $orders = $this->approvedRentWithDriverOrders()->where('status', 'approved')->get();
            foreach($orders as $order)
            {
                $price+=$order->total_price;
            }
        }
        return $price;
    }

    public function getLastBookingDate()
    {
        if($this->rent_type=="simple_rent")
        {
            return $this->simpleApprovedRentOrders()->where('status', 'approved')->
            where('approved_booking', '!=', null)->orderBy('approved_booking', 'desc')->first();
        }elseif($this->rent_type=="with_driver")
        {
            return $this->approvedRentWithDriverOrders()->where('status', 'approved')->
           where('approved_booking', '!=', null)->orderBy('approved_booking', 'desc')->first();
        }
    }

    public function approvedRentWithDriverOrders()
    {
        return $this->hasMany(OrderDriver::class, 'car_id', 'id');
    }

    public function simpleApprovedRentOrders()
    {
        return $this->hasMany(Order::class, 'car_id', 'id');
    }

    public function simpleRentGetPrice($days)
    {
        if ($days == 1) {
            return $this->simpleRent->price_day_1*$days;
        }

        if ($days == 2) {
            return $this->simpleRent->price_day_2*$days;
        }

        if ($days>=3&&$days <= 6) {
            return $this->simpleRent->price_day_3_6*$days;
        }

        if ($days >= 7 && $days <= 13) {
            return $this->simpleRent->price_day_7_13*$days;
        }

        if ($days >= 14 && $days <= 20) {
            return $this->simpleRent->price_day_14_20*$days;
        }

        if ($days >= 21 && $days <= 29) {
            return $this->simpleRent->price_day_21_29*$days;
        }

        if ($days >= 30) {
            return $this->simpleRent->price_day_30*$days;
        }
    }

    public function banners()
    {
        return $this->morphToMany(Banner::class, 'bannersable');
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }

    public function scopeFilter2(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }
}
