<?php

namespace App\Http\Controllers\Api;

use App\TicketType;
use Illuminate\Http\Request;
use App\Http\Resources\TicketType as TicketTypeResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TicketTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('store_want');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket_type = TicketType::has('festival')
            ->with(['festival','tickets' => function ($q) {  $q->Available()->LatestBump()->has('user'); }])
            ->withCount(['tickets as tickets_available_count' => function ($q) { $q->Available()->has('user'); }, 'tickets as tickets_sold_count' => function ($q) { $q->Sold();}, 'users as tickets_wanted_count'])
            ->OnSale()
            ->findOrFail($id);

        return new TicketTypeResource($ticket_type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $id
     */
    public function store_want($id)
    {
        $user = Auth::user();
        $ticket_type = TicketType::find($id);
        if($user->ticket_types->contains($ticket_type)) {
            return response()->json('Ticket already on wanted list.', 406);
        }
        $user->ticket_types()->attach($id);
        return response()->json('Successfully added ticket to wanted list.');
    }
}
