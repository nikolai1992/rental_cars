<?php

namespace App\Http\Requests\Admin\CarBrand;

use Illuminate\Foundation\Http\FormRequest;

class CarBrandStoreRequest extends FormRequest
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
            'icon' =>'image|required|mimes:jpeg,png,jpg',
            'name' => 'max:191',
            'brand' => 'max:191',
            'alias'=> 'required|max:191|regex:#^[\w-]#|unique:car_brands,alias',
        ];
    }
}
