<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDriver extends Model
{
    //
    public $table = "order_drivers";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id', 'id');
    }

    public function car()
    {
        return $this->belongsTo('App\Models\Car','car_id', 'id');
    }
}
