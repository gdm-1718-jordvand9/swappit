<?php

namespace App\Http\Requests\Api;

use App\Rules\Api\ValidTicketEndDate;
use App\Rules\Api\ValidTicketPrice;
use App\Rules\Api\ValidTicketStartDate;
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
        $ticket_type = $this->request->get('ticket_type');
        return [

            'ticket_type'       => 'required',
            'price'             => ['required','regex:/^\d*(\.\d{1,2})?$/', new ValidTicketPrice($ticket_type)],
            'end_date'          => ['required','date_format:"Y-m-d"', new ValidTicketEndDate($ticket_type)],
            'start_date'        => ['required','date_format:"Y-m-d"','before_or_equal:end_date', new ValidTicketStartDate($ticket_type)],
            'published'         => 'required|boolean',
            'code'              => 'required|string',
        ];
    }
}
