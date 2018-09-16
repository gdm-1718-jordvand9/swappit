<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FestivalRequest extends FormRequest
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
            'name'          => 'required|max:25',
            'place'         => 'required|min:4|max:20',
            'description'   => 'required|min:10|max:400',
            '*_url'         => 'nullable|url',
            'start_date'    => 'required|date_format:"Y-m-d"',
            'end_date'      => 'required|date_format:"Y-m-d"',
        ];
    }
}
