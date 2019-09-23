<?php

namespace App\Http\Requests\works;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WorkUpdateRequest extends FormRequest
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
            'name' => ['string','max:150', Rule::unique('works', 'name')->ignore($this->work->id)],
            'description' => 'string|max:250'
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'This Work Name already exist',
            'name.string' => 'This field must be string only',
            'name.max' => 'Can\'t be more than 150 char',
            'description.string' => 'This field must be string only',
            'description.max' => 'Can\'t be more than 250 char',
        ];
    }
}
