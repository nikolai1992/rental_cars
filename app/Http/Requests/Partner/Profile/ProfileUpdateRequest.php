<?php

namespace App\Http\Requests\Partner\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(auth()->user()->id)
            ],
            'password' => 'nullable|string|min:8',
            'first_name' => 'required|string|max:191',
            'site' => 'max:191',
            'phone' => 'required|max:191',
            'phone2' => 'required|max:191',
            'phone3' => 'required|max:191',
        ];
    }
}
