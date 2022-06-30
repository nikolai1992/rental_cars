<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    //
    protected $guarded = [];

    public function article()
    {
        return $this->belongsTo('App\Models\Article','article_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id', 'id');
    }
}
