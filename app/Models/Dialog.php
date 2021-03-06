<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    //
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id', 'id');
    }
}
