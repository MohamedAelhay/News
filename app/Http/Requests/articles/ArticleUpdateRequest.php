<?php

namespace App\Http\Requests\articles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'main_title' => ['required','string','max:150','min:3',Rule::unique('articles','main_title')->ignore($this->main_title)],
            'second_title' => 'required|string|max:150|min:3',
            'content' => 'required|string',
            'type' => 'required|string',
            'related_id' => 'required',
            'user_id' => 'required',
            'images' => 'required',
            'files' => 'required',
        ];
    }
}
