<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    //Данная модель является не "статусом", а темой тикета.
    //по ошибке названо так
    protected $guarded = [];

    public function translates()
    {
        return $this->morphToMany(Translation::class, 'translationsable');
    }

    public function getTranslation($field, $lang_id=false)
    {
        $language = Language::where('code', app()->getLocale())->first();
        $result = $this->translates()
            ->where('field', $field)
            ->where('language_id', $lang_id ? $lang_id : $language->id)
            ->first();

        return $result ? $result->value : null;
    }
}
