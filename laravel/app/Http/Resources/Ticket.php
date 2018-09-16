<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Ticket extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id'                => $this->id,
            'sold'              => $this->sold,
            'published'         => $this->published,
            'price'             => $this->price,
            'start_date'        => $this->start_date,
            'end_date'          => $this->end_date,
            'user'              => new User($this->user),
            'ticket_type'       => new TicketType($this->whenLoaded('ticket_type')),
        ];
    }
}
