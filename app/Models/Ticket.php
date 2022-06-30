<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $guarded = [];

    public function dialogs()
    {
        return $this->hasMany(Dialog::class, 'ticket_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\TicketStatus','theme', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id', 'id');
    }

    public function getUnreadDialogs()
    {
        return count(
            $this->dialogs()->where('opened', false)
            ->where("user_id", '!=', auth()->user()->id)
            ->get()
        );
    }
}
