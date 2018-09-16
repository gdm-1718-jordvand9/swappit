<?php

namespace App\Http\Controllers;

use App\Festival;
use App\Http\Requests\TicketTypeRequest;
use App\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticket_types = TicketType::with('trashed_festival')->withTrashed()
            ->latest()
            ->paginate();

        return view('ticket_type.index', compact('ticket_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $festivals = Festival::withTrashed()->pluck('name', 'id')->all();
        return view('ticket_type.create', compact('ticket_type','festivals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketTypeRequest $request)
    {
        $ticket_type = new TicketType();
        $ticket_type->name             = $request->name;
        $ticket_type->description      = $request->description;
        $ticket_type->price            = $request->price;
        $ticket_type->festival_id      = $request->festival;
        $ticket_type->sale_start_date  = $request->sale_start_date;
        $ticket_type->sale_end_date    = $request->sale_end_date;
        $ticket_type->save();
        return redirect('ticket_types')->with(['message' => $ticket_type->name, 'datatype' => 'TicketType', 'crudtype' => 'created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket_type = TicketType::with('trashed_festival')->withTrashed()->findOrFail($id);
        //$totalSold = $ticket_type->TicketSoldCount();
        //$totalAvailable = $ticket_type->TicketAvailableCount();

        return view('ticket_type.show', compact('ticket_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket_type = TicketType::withTrashed()->findOrFail($id);
        $festivals = Festival::withTrashed()->pluck('name', 'id')->all();
        return view('ticket_type.edit', compact('ticket_type','festivals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketTypeRequest $request, $id)
    {
        $ticket_type = TicketType::withTrashed()->findOrFail($id);
        $ticket_type->name             = $request->name;
        $ticket_type->description      = $request->description;
        $ticket_type->price            = $request->price;
        $ticket_type->festival_id      = $request->festival;
        $ticket_type->sale_start_date  = $request->sale_start_date;
        $ticket_type->sale_end_date    = $request->sale_end_date;
        $ticket_type->update();
        return redirect('ticket_types')->with(['message' => $ticket_type->name, 'datatype' => 'TicketType', 'crudtype' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket_type = TicketType::with('trashed_festival')->withTrashed()->findOrFail($id);
        $ticket_type->delete();
        return redirect('ticket_types')->with(['message' => $ticket_type->trashed_festival->name . ' - ' . $ticket_type->name, 'datatype' => 'TicketType', 'crudtype' => 'deleted']);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $ticket_type = TicketType::with('trashed_festival')->withTrashed()->findOrFail($id);
        $ticket_type->restore();

        return redirect('ticket_types')->with(['message' => $ticket_type->trashed_festival->name . ' - ' . $ticket_type->name, 'datatype' => 'TicketType', 'crudtype' => 'restored']);
    }

    /**
     * Force Delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $ticket_type = TicketType::withTrashed()->findOrFail($id);
        $ticket_type->forceDelete();

        return redirect('ticket_types')->with(['message' => $ticket_type->name, 'datatype' => 'TicketType', 'crudtype' => 'forcedeleted']);
    }
}
