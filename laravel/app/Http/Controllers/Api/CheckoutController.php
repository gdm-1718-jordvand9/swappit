<?php

namespace App\Http\Controllers\Api;

use App\Jobs\CancelOrderAutomatically;
use App\Order;
use App\Ticket;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Ticket as TicketResource;
use App\Http\Resources\Order as OrderResource;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('confirm_create');
    }


    public function pay_create($id)
    {
        $order = Order::with('tickets.ticket_type.festival','tickets.user')->findOrFail($id);
        $user = User::findOrFail($order->user_id);
        if(Auth::user()->id === $user->id && $order->status === 'placed')
        {

            return response()->json(new OrderResource($order));
        } else {
            return response()->json('Access to this payment is denied.', 404);
        }
    }
    public function pay_store($id)
    {
        $order = Order::findOrFail($id);
        $user = User::findOrFail($order->user_id);
        if(Auth::user()->id === $user->id && $order->status === 'placed'){
            $order->update(['status' => 'payed', 'payed_at' => Carbon::now()]);
            $user->sendOrderCompletedMail($order);
            $tickets = $order->tickets()->get();
            foreach ($tickets as $ticket) {
                $ticket->user->sendTicketSoldMail($ticket);
                $ticket->update(['sold' => 1]);
            }
            $order->update(['status' => 'completed', 'completed_at' => Carbon::now()]);
            return response()->json('Successfully payed order' . $order->id);

        }
        return response()->json('Access to this payment is denied.', 401);
    }
    public function cancel($id) {
        $order = Order::findOrFail($id);
        $user = User::findOrFail($order->user_id);
        if(Auth::user()->id === $user->id && $order->status === 'placed') {
            $order->update(['status' => 'cancelled', 'cancelled_at' => Carbon::now()]);
            $tickets = $order->tickets()->get();
            foreach ($tickets as $ticket) {
                $ticket->update(['sold' => 0, 'published' => 1, 'order_id' => null]);
            }
        }

    }
}
