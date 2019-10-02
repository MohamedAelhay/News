<?php

namespace App\Http\Requests\visitors;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VisitorRequest extends FormRequest
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
            'email' => ['required','email',Rule::unique('users', 'email')->ignore(isset($this->visitor->user_id) ? $this->visitor->user_id : null)],
            'image' => 'sometimes|image|mimes:jpeg,jpg,png',
            'phone' => 'required|numeric',
            'gender' => 'required',
            'city_id' => 'required|numeric',
            'country_id' => 'required|numeric',
        ];
    }
}
