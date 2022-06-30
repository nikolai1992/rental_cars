<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'name' => 'required|string|max:191',
            'first_name' => 'max:191',
            'role_id' => 'required',
            'site' => 'max:191',
            'phone' => 'max:191',
            'phone2' => 'max:191',
            'phone3' => 'max:191',
        ];
    }
}
