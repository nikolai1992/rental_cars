<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 *
 * @package App\Admin
 * @property  string name
 * @property  string price
 * @property  string note
 * @property  boolean active
 * @property int priority
 */
class Service extends Model
{
    protected $guarded=[];
    protected $casts = [
        'active' => 'boolean',
    ];
}
