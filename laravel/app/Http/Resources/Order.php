<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
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
            'id' => $this->id,
            'status' => $this->status,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'placed_at' =>$this->placed_at,
            'user' => new User($this->whenLoaded('user')),
            'tickets' => Ticket::collection($this->whenLoaded('tickets')),
        ];
    }
}
