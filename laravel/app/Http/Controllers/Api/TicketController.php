<?php

namespace App\Http\Controllers\Api;

use App\Festival;
use App\Http\Requests\Api\TicketRequest;
use App\Ticket;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Ticket as TicketResource;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('store', 'toggle_published', 'edit', 'indexAvailableAndSold', 'bump');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has('sort') && request()->has('type')) {
            $tickets = Ticket::Available()
                ->has('user')
                ->whereHas('ticket_type', function ($q) {
                    $q->OnSale();
                })
                ->has('ticket_type.festival')
                ->with('user', 'ticket_type.festival')
                ->orderBy(request('sort'), request('type'))
                ->paginate(9)->appends(['sort' => request('sort'), 'type' => request('type')]);
        }
        else {
            $tickets = Ticket::Available()
                ->has('user')
                ->whereHas('ticket_type', function ($q) {
                    $q->OnSale();
                })
                ->has('ticket_type.festival')
                ->with('user', 'ticket_type.festival')
                ->LatestBump()
                ->paginate(9);
        }

        return TicketResource::collection($tickets);
    }

    /**
     * Show the data for creating a new resource.
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
    public function store(TicketRequest $request)
    {
        $ticket = new Ticket();
        $ticket->price          = $request->price;
        $ticket->code           = $request->code;
        $ticket->user_id        = Auth::user()->id;
        $ticket->start_date     = $request->start_date;
        $ticket->end_date       = $request->end_date;
        $ticket->ticket_type_id = $request->ticket_type;
        $ticket->published      = $request->published;
        $ticket->bump_date      = now();
        $ticket->sold           = 0;
        $ticket->save();

        return response()->json('Successfully created ticket.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        //dd($ticket);
        return response()->json($ticket);
    }

    /**
     * Show the date for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::where('user_id', Auth::id())->findOrFail($id);
        //dd($ticket);
        return new TicketResource($ticket);
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function account_index()
    {
        $user = Auth::user();
        //$tickets = Auth::user()->has('tickets');
        $tickets = $user->tickets()->
        with(['ticket_type' => function ($q) {
            $q->withTrashed()->with(['festival' => function ($q) {
                $q->withTrashed();
            }]);
        }])->paginate(9);
        //$tickets = Auth::user()->with(['tickets'])->withTrashed()->paginate(9);
        return TicketResource::collection($tickets);
    }

    public function toggle_published($id)
    {
        $ticket = Ticket::findOrFail($id);
        $user = Auth::user();
        if ($user->id === $ticket->user->id) {
            $ticket->published = !$ticket->published;
            $ticket->save();
            return response()->json('Successfully updated publish value.');
        }
        return response()->json("You're not allowed to update this ticket.");
    }

    public function indexAvailableAndSold(Request $request)
    {
        $request->validate([
            'tickets' => 'required'
        ]);

        $tickets_available = Ticket::Available()->whereHas('ticket_type', function($q) { $q->OnSale();})->with('ticket_type.festival')->find($request->tickets);
        $tickets_sold = Ticket::Sold()->with('ticket_type.festival')->find($request->tickets);
        $tickets_saleclosed = Ticket::whereHas('ticket_type', function($q) {$q->NotOnSale();})->with('ticket_type.festival')->find($request->tickets);
        $merged = $tickets_sold->merge($tickets_saleclosed);
        return response()->json(['tickets_available' => TicketResource::collection($tickets_available), 'tickets_sold' => TicketResource::collection($merged)]);
    }

    public function bump($id)
    {
        $ticket = Auth::user()->tickets()->findOrFail($id);
        if ($ticket->bump_date < Carbon::now()->subDays(2)) {
            $ticket->update(['bump_date' => Carbon::now()]);
            return response()->json('Successfully bumped ticket.');
        }
        return response()->json('Ticket is not older than two days.', 422);
    }
}
