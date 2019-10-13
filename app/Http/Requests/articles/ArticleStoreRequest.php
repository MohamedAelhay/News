<?php

namespace App\Http\Requests\articles;

use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
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
            'main_title' => 'required|string|max:150|min:3|unique:articles,main_title',
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
