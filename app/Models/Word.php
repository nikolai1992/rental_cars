<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    //
    protected $guarded = [];

    public function translations()
    {
        return $this->morphToMany(Translation::class, 'translationsable');
    }
}
