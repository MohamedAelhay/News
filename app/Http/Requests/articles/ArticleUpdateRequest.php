<?php

namespace App\Http\Requests\articles;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
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
            'main_title' => ['string','max:150','min:3',Rule::unique('articles','main_title')->ignore($this->article)],
            'second_title' => 'string|max:150|min:3',
            'content' => 'string',
            'type' => 'exists:works,id',
            'related_id' => 'exists:articles,id',
            'user_id' => 'exists:users,id',
//            'images' => 'required',
//            'files' => 'required',
        ];
    }
}
