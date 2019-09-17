<?php

namespace App\Http\Requests\cities;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CityUpdateRequest extends FormRequest
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
            'name' => ['string','max:150', Rule::unique('cities', 'name')->ignore($this->city->id)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'This City already exist',
            'name.string' => 'This field must be string only',
            'name.max' => 'Can\'t be more than 150 char',
        ];
    }
}
