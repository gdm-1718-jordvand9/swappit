<?php

namespace App\Http\Controllers;

use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('trashed_user')->withTrashed()
            ->latest()
            ->paginate();
        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('trashed_tickets.trashed_ticket_type.trashed_festival')->withTrashed()->findOrFail($id);
        return view('order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
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
        $order = Order::withTrashed()->findOrFail($id);
        $order->delete();

        return redirect('orders')->with(['message' => $order->id, 'datatype' => 'Order', 'crudtype' => 'softdeleted']);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $order = Order::withTrashed()->findOrFail($id);
        $order->restore();

        return redirect('orders')->with(['message' => $order->id, 'datatype' => 'Order', 'crudtype' => 'restored']);
    }

    /**
     * Force Delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $order = Order::withTrashed()->findOrFail($id);
        $order->forceDelete();

        return redirect('orders')->with(['message' => $order->id, 'datatype' => 'Order', 'crudtype' => 'forcedeleted']);
    }
    /**
     * Cancel  the specified order from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id) {
        $order = Order::withTrashed()->findOrFail($id);
        // Check if order is completed / payed
        if ( $order->payed_at || $order->completed_at || $order->cancelled_at || $order->status === 'completed' || $order->status === 'payed' || $order->status === 'cancelled' ) {
            dd('order is completed or payed');
        }
        $order->update(['status' => 'cancelled', 'cancelled_at' => Carbon::now()]);
        $tickets = $order->tickets()->get();
        foreach ($tickets as $ticket) {
            $ticket->update(['sold' => 0, 'published' => 1, 'order_id' => null]);
        }
        return redirect('orders')->with(['message' => $order->id, 'datatype' => 'Order', 'crudtype' => 'cancelled']);
    }

    /**
     * Cancel  the specified order from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complete($id) {
        $order = Order::withTrashed()->findOrFail($id);
        // Check if order has not been cancelled.
        if ( $order->cancelled_at || $order->status === 'cancelled' || $order->completed_at || $order->status === 'completed') {
            dd ('order has been cancelled.');
        }
        $order->update(['status' => 'payed', 'payed_at' => Carbon::now()]);
        $order->user->sendOrderCompletedMail($order);
        $tickets = $order->tickets()->get();
        foreach ($tickets as $ticket) {
            $ticket->user->sendTicketSoldMail($ticket);
            $ticket->update(['sold' => 1]);
        }
        $order->update(['status' => 'completed', 'completed_at' => Carbon::now()]);
        return redirect('orders')->with(['message' => $order->id, 'datatype' => 'Order', 'crudtype' => 'completed']);
    }
}
