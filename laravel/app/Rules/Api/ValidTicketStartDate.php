<?php

namespace App\Rules\Api;

use App\TicketType;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class ValidTicketStartDate implements Rule
{
    protected $ticket_type;
    protected $ticket_type_start_date;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($ticket_type)
    {
        $this->ticket_type = $ticket_type;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $ticket_type = TicketType::findOrFail($this->ticket_type);
        $this->ticket_type_start_date = $ticket_type->sale_start_date;
        if(Carbon::parse($value) < Carbon::parse($this->ticket_type_start_date)) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The ticket sale :attribute cannot be earlier than ' . $this->ticket_type_start_date;
    }
}
