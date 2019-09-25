<?php

namespace App\Http\Requests\staff;

use Illuminate\Foundation\Http\FormRequest;

class StaffStoreRequest extends FormRequest
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
            'fname' => 'required|string|max:150',
            'lname' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email',
            'image' => 'required|image|mimes:jpeg,jpg,png',
            'phone' => 'required|numeric',
            'gender' => 'required',
            'work_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'country_id' => 'required|numeric',
        ];
    }
}
