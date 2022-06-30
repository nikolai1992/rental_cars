<?php

namespace App\Http\Requests\Admin\Page;

use Illuminate\Foundation\Http\FormRequest;

class PageUpdateRequest extends FormRequest
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
        $page = $this->route('page');
        if(!$page->basic)
        {
            return [
                'alias'=> 'required|max:191|regex:#^[\w-]#|unique:pages,alias,'.$page->id,
            ];
        }

    }
}
