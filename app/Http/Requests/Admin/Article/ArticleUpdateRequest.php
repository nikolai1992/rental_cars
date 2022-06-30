<?php

namespace App\Http\Requests\Admin\Article;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
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
        $id = $this->route('article')->id;

        return [
            'alias'=> 'required|max:191|regex:#^[\w-]#|unique:articles,alias,'.$id,
            'image' =>'image|mimes:jpeg,png,jpg',
        ];
    }
}
