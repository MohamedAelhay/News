<?php

namespace App\Http\Requests\staff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffUpdateRequest extends FormRequest
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
            'fname' => 'string|max:150',
            'lname' => 'string|max:150',
            'email' => ['email', Rule::unique('users', 'email')->ignore($this->staff->user_id)],
            'image' => 'image|mimes:jpeg,jpg,png',
            'phone' => 'numeric',
            'gender' => 'string',
            'work_id' => 'numeric',
            'city_id' => 'numeric',
            'country_id' => 'numeric',
        ];
    }
}
