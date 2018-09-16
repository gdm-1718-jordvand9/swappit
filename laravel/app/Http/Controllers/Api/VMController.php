<?php

namespace App\Http\Controllers\Api;

use App\Festival;
use App\TicketType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VMController extends Controller
{
    public function vm_festivals()
    {
        $festivals = Festival::pluck('name', 'id')->all();
        return response()->json($festivals);
    }

    public function vm_ticket_types($id)
    {
        $ticket_types = TicketType::where('festival_id', $id)->pluck('name', 'id')->all();
        return response()->json($ticket_types);
    }

    public function vm_ticket_types_info($id)
    {
        $ticket_type = TicketType::findOrFail($id);
        return response()->json([
            'price' => $ticket_type->price,
            'sale_end_date' => $ticket_type->sale_end_date,
            'sale_start_date' => $ticket_type->sale_start_date,
            'price_max' => round($ticket_type->price * 1.05, 2),
            'price_min' => round($ticket_type->price * 0.95,2),
        ]);
    }
}
