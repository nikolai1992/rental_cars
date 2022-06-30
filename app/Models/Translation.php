<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
Relation::morphMap([
    'word' => 'App\Models\Word',
    'article' => 'App\Models\Article',
    'faq' => 'App\Models\FAQ',
    'page' => 'App\Models\Page',
    'ticket status' => 'App\Models\TicketStatus',
]);
class Translation extends Model
{
    //
    protected $guarded = [];

    public static function getTranslWord($words, $sel_lang, $code)
    {
        return $words->where('name', $code)->first() ? $words->where('name', $code)->first()->translations->where("language_id", $sel_lang->id)->first()->value : '';
    }

    public function translationsable() {
        return $this->morphTo();
    }
}
