<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WithDriverRentMailRequest extends FormRequest
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
            'phone' => 'required|max:191',
//            'g-recaptcha-response' => 'required',
            'email' => 'required|email',
            'fio' => 'required|max:191',
        ];
    }
}
