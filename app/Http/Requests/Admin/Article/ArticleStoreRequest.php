<?php

namespace App\Http\Requests\Admin\Article;

use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'alias'=> 'required|max:191|regex:#^[\w-]#|unique:articles,alias',
            'image' =>'image|required|mimes:jpeg,png,jpg',
        ];
    }
}
