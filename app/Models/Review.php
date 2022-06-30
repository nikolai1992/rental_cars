<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Review::class, 'review_id', 'id');
    }
}
