<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketType extends JsonResource
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
            'id'                        => $this->id,
            'name'                      => $this->name,
            'description'               => $this->description,
            'price'                     => $this->price,
            'sale_start_date'           => $this->sale_start_date,
            'sale_end_date'             => $this->sale_end_date,
            'tickets_sold_count'        => $this->tickets_sold_count,
            'tickets_available_count'   => $this->tickets_available_count,
            'tickets_wanted_count'      => $this->tickets_wanted_count,
            'tickets'                   => Ticket::collection($this->whenLoaded('tickets')),
            'festival'                  => new Festival($this->whenLoaded('festival')),
        ];
    }
}
