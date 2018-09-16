<?php

namespace App\Http\Controllers;

use App\Festival;
use App\Http\Requests\TicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Ticket;
use App\TicketType;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::with('trashed_ticket_type.trashed_festival','trashed_user', 'trashed_order')->withTrashed()->latest()->paginate();
        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $festivals = Festival::withTrashed()->pluck('name', 'id')->all();
        $ticket_types = TicketType::withTrashed()->pluck('name', 'id')->all();
        $users = User::withTrashed()->pluck('name', 'id')->all();
        return view('ticket.create', compact('festivals', 'users', 'ticket_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketRequest $request)
    {
        $ticket = new Ticket();
        $ticket->price          = $request->price;
        $ticket->code           = Crypt::encryptString($request->code);
        $ticket->start_date     = $request->start_date;
        $ticket->end_date       = $request->end_date;
        $ticket->ticket_type_id = $request->tickettype;
        $ticket->user_id        = $request->user;
        $ticket->bump_date      = Carbon::now();
        $ticket->sold           = $request->sold;
        $ticket->published      = $request->published;
        $ticket->save();

        return redirect('tickets')->with(['message' => $ticket->trashed_ticket_type->trashed_festival->name . ' - ' . $ticket->trashed_ticket_type->name, 'datatype' => 'Ticket', 'crudtype' => 'created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::with('trashed_ticket_type.trashed_festival','trashed_user')->withTrashed()->findOrFail($id);
        return view('ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::withTrashed()->findOrFail($id);
        $festivals = Festival::withTrashed()->pluck('name', 'id')->all();
        $ticket_types = TicketType::withTrashed()->pluck('name', 'id')->all();
        $users = User::withTrashed()->pluck('name', 'id')->all();
        return view('ticket.edit', compact('ticket','festivals','ticket_types', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, $id)
    {
        $ticket = Ticket::with('trashed_ticket_type.trashed_festival','trashed_user')->withTrashed()->findOrFail($id);
        $ticket->price          = $request->price;
        $ticket->start_date     = $request->start_date;
        $ticket->end_date       = $request->end_date;
        $ticket->ticket_type_id = $request->tickettype;
        $ticket->user_id        = $request->user;
        $ticket->sold           = $request->sold;
        $ticket->published      = $request->published;
        $ticket->update();

        return redirect('tickets')->with(['message' => $ticket->trashed_ticket_type->trashed_festival->name . ' - ' . $ticket->trashed_ticket_type->name . ' - ' . $ticket->trashed_user->name, 'datatype' => 'Ticket', 'crudtype' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::with('trashed_ticket_type.trashed_festival')->withTrashed()->findOrFail($id);
        $ticket->delete();
        return redirect('tickets')->with(['message' => $ticket->trashed_ticket_type->name . ' - ' . $ticket->trashed_ticket_type->trashed_festival->name, 'datatype' => 'Ticket', 'crudtype' => 'deleted']);

    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $ticket = Ticket::with('trashed_ticket_type.trashed_festival')->withTrashed()->findOrFail($id);
        $ticket->restore();
        return redirect('tickets')->with(['message' => $ticket->trashed_ticket_type->name . ' - ' . $ticket->trashed_ticket_type->trashed_festival->name, 'datatype' => 'Ticket', 'crudtype' => 'restored']);
    }

    /**
     * Force Delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $ticket = Ticket::withTrashed()->findOrFail($id);
        $ticket->forceDelete();

        return redirect('tickets')->with(['message' => $ticket->id, 'datatype' => 'Ticket', 'crudtype' => 'forcedeleted']);
    }
}
