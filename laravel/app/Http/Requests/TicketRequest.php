<?php

namespace App\Http\Requests;


use App\Festival;
use App\Rules\Api\ValidTicketPrice;
use App\TicketType;
use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
        //dd($maxPrice);
        return [
            'tickettype'   => 'required',
            'festival'      => 'required',
            'sold'          => 'nullable|boolean',
            'published'     => 'nullable|boolean',
            'price'         => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'start_date'    => 'required|date_format:"Y-m-d"',
            'end_date'      => 'required|date_format:"Y-m-d"',
            'user'          => 'required',
            'code'          => 'required',
        ];
    }
}
