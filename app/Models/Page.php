<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $guarded = [];

    public function translations()
    {
        return $this->morphToMany(Translation::class, 'translationsable');
    }

    public function getTranslation($field, $lang_id=false)
    {
        $language = Language::where('code', app()->getLocale())->first();
        $result = $this->translations()
            ->where('field', $field)
            ->where('language_id', $lang_id ? $lang_id : $language->id)
            ->first();

        return $result ? $result->value : null;
    }

    public function banners()
    {
        return $this->morphToMany(Banner::class, 'bannersable');
    }
}
