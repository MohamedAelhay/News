<?php

namespace App\Http\Requests\events;

use App\Rules\Latitude;
use App\Rules\Longitude;
use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
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
            'main_title'   => 'required|string|min:3|max:150',
            'second_title' => 'required|string|min:3|max:150',
            'visitors'     => 'required|array',
            'start_date'   => 'required|date|after:today',
            'end_date'     => 'required|date|after:start_date',
            'content'      => 'required|string',
            'images'       => 'required|array',
            'address'      => 'required|string',
            'latitude'     => ['required', new Latitude($this->latitude)],
            'longitude'    => ['required', new Longitude($this->longitude)]
        ];
    }
}
