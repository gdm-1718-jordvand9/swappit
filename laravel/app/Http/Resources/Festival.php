<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Festival extends JsonResource
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
            'slug'                      => $this->slug,
            'place'                     => $this->place,
            'description'               => $this->description,
            'start_date'                => $this->start_date,
            'end_date'                  => $this->end_date,
            'tickets_available_count'   => $this->tickets_available_count,
            'tickets_sold_count'        => $this->tickets_sold_count,
            'tickets_wanted_count'      => $this->tickets_wanted_count,
            'facebook_url'              => $this->facebook_url,
            'twitter_url'               => $this->twitter_url,
            'instagram_url'             => $this->instagram_url,
            'snapchat_url'              => $this->snapchat_url,
            'ticket_types'              => TicketType::collection($this->whenLoaded('ticket_types')),
        ];
    }
}
