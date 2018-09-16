<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketTypeRequest extends FormRequest
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
            'name'              => 'required|max:25',
            'description'       => 'required|min:10',
            'festival'          => 'required',
            'sale_start_date'   => 'required|date_format:"Y-m-d"',
            'sale_end_date'     => 'required|date_format:"Y-m-d"',
            'price'             => 'required|regex:/^\d*(\.\d{1,2})?$/'
        ];
    }
}
