<?php

namespace App\Rules\Api;

use App\TicketType;
use Illuminate\Contracts\Validation\Rule;

class ValidTicketPrice implements Rule
{
    protected $ticket_type;
    protected $ticket_Price_max;
    protected $ticket_Price_min;
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
        $ticket_type_Price = $ticket_type->price;
        $this->ticket_Price_max = $ticket_type_Price * 1.05;
        $this->ticket_Price_min = $ticket_type_Price * 0.95;
        if(($this->ticket_Price_min <= $value) && ($value <= $this->ticket_Price_max)){
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be between ' . $this->ticket_Price_min . ' and ' . $this->ticket_Price_max;
    }
}
