<?php

namespace App\Http\Requests\Admin\Car;

use Illuminate\Foundation\Http\FormRequest;

class CarUpdateRequest extends FormRequest
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
        $id = $this->route('car');

        return [
            'car.brand_id' => 'required',
            'car.model' => 'required|max:191',
            'car.engine' => 'required|max:191',
            'car.horsepower' => 'required|max:191',
            'car.max_speed' => 'required|max:191',
            'car.time_to_100' => 'required|max:191',
            'car.color' => 'required|max:191',
            'car.cabin_color' => 'required|max:191',
            'car.trunk_capacity' => 'max:191',
            'car.alias'=> 'required|max:191|regex:#^[\w-]#|unique:cars,alias,'.$id,
        ];
    }
}
