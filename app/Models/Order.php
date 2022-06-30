<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public $table = "orders";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id', 'id');
    }

    public function order_drivers()  {
        return OrderDriver::where('user_id', auth()->user()->id);
    }

    public function car()
    {
        return $this->belongsTo('App\Models\Car','car_id', 'id');
    }
}
