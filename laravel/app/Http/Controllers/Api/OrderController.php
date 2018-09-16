<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Order as OrderResource;
use App\Jobs\CancelOrderAutomatically;
use App\Order;
use App\Ticket;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Auth::user()
            ->orders()
            ->with(['tickets.ticket_type.festival', 'tickets.user'])
            ->latest()
            ->paginate(9);
        return OrderResource::collection($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tickets' => 'required'
        ]);

        $validTickets = Ticket::whereNull('order_id')->find($request->tickets);

        if(!empty($request->tickets) && !empty($validTickets))
        {
            $order              = new Order();
            $order->status      = 'placed';
            $order->user_id     = Auth::user()->id;
            $order->placed_at   = Carbon::now();
            $order->save();

            $order_price = 0;
            foreach ($validTickets as $ticket)
            {
                $order_price = $order_price + $ticket->price;
                $ticket->update(['published' => 0, 'order_id' => $order->id]);
            }
            $order->update(['price' => $order_price]);
            CancelOrderAutomatically::dispatch($order)->delay(now()->addMinute(1));
            return response()->json(new OrderResource(Order::with('tickets.ticket_type.festival','tickets.user')->findOrFail($order->id)));
        }
        return response()->json('No valid tickets submitted.');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Auth::user()->orders()->with(['tickets.ticket_type.festival', 'tickets.user'])->findOrFail($id);
        return  new OrderResource($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pay($id) {
        $order = Auth::user()
            ->orders()
            ->findOrFail($id);

        $order->update(['status' => 'payed', 'payed_at' => Carbon::now()]);
        $order->user->sendOrderCompletedMail($order);
        $tickets = $order->tickets()->get();
        foreach ($tickets as $ticket) {
            $ticket->user->sendTicketSoldMail($ticket);
            $ticket->update(['sold' => 1]);
        }
        $order->update(['status' => 'completed', 'completed_at' => Carbon::now()]);
        return response()->json('Successfully payed order.', 200);
    }

    public function cancel($id) {
        $order = Auth::user()->orders()->findOrFail($id);
        // Check if order has not been completed
        if ( $order->payed_at || $order->completed_at || $order->status === 'completed' || $order->status === 'payed') {
            return response()->json('Cannot cancel order once it has been completed or payed.');
        }
        if ( $order->cancelled_at || $order->status === 'cancelled') {
            return response()->json('Order already cancelled.', 405);
        }
        $order->update(['status' => 'cancelled', 'cancelled_at' => Carbon::now()]);
        $tickets = $order->tickets()->get();
        foreach ($tickets as $ticket) {
            $ticket->update(['sold' => 0, 'published' => 1, 'order_id' => null]);
        }
        return response()->json('Succesfully cancelledorder', 200);
    }
}
