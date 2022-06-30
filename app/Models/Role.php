<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $casts
        = [
            'is_white_title' => 'boolean',
            'is_chose'       => 'boolean',
            'slider'         => 'array',
            'attrib_ru'      => 'array',
            'attrib_en'      => 'array',

        ];


}
