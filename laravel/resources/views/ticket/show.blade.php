@extends('layouts.app')

@section('content')
    @if($ticket->deleted_at)
    <div class="card border-danger">
        <div class="card-header text-danger">
            Ticket
            <a href="/tickets" class="float-right text-danger"><i class="fas fa-list-ul"></i></a>
        </div>
        <div class="card-body">
            <h4>{{$ticket->trashed_ticket_type->trashed_festival->name}} - {{$ticket->trashed_ticket_type->name}}</h4>
            <p>{{$ticket->trashed_user->name}}</p>
            <p>Price: € {{$ticket->price}}</p>
            <p>Sold:{{$ticket->sold}}</p>
            <p>Published:{{$ticket->published}}</p>
            @if($ticket->order_id)
                <a class="mb-3" href="/orders/{{$ticket->trashed_order->id}}">Order: {{$ticket->trashed_order->id}}</a>
            @endif
            <p>Tickettype verkoopt verloopt van <strong>{{$ticket->trashed_ticket_type->sale_start_date}}</strong> tot <strong>{{$ticket->trashed_ticket_type->sale_end_date}}</strong>.</p>
            <p>Ticketverkoop loopt van <strong>{{$ticket->start_date}}</strong> tot <strong>{{$ticket->end_date}}</strong>.</p>
            <a class="btn btn-outline-danger" href="/tickets/{{$ticket->id}}/edit" role="button"><i class="far fa-edit"></i> Edit</a>
            <form action="/tickets/{{$ticket->id}}/restore" method="POST" class="d-inline-block pr-1">
                @method('PATCH')
                @csrf
                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#restoreModal-{{$ticket->id}}"><i class="fas fa-plus-circle"></i> Restore</button>
                @component('components.restore-modal')
                    @slot('id')
                        {{$ticket->id}}
                    @endslot
                    @slot('datatype')
                        ticket
                    @endslot
                    @slot('name')
                        {{ $ticket->trashed_ticket_type->name }}
                    @endslot
                @endcomponent
            </form>
            <form action="/tickets/{{$ticket->id}}/delete" method="POST" class="d-inline-block">
                @method('DELETE')
                @csrf
                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#hardDeleteModal-{{$ticket->id}}"><i class="fas fa-trash"></i> Hard delete</button>
                @component('components.harddelete-modal')
                    @slot('id')
                        {{$ticket->id}}
                    @endslot
                    @slot('datatype')
                        ticket
                    @endslot
                    @slot('name')
                        {{ $ticket->trashed_ticket_type->name }}
                    @endslot
                @endcomponent
            </form>
        </div>
    </div>
    @else
        <div class="card">
            <div class="card-header">
                Ticket
                <a href="/tickets" class="float-right"><i class="fas fa-list-ul"></i></a>
            </div>
            <div class="card-body">
                <h4>{{$ticket->trashed_ticket_type->trashed_festival->name}} - {{$ticket->trashed_ticket_type->name}}</h4>
                <p>{{$ticket->trashed_user->name}}</p>
                <p>Price: € {{$ticket->price}}</p>
                <p>Sold:{{$ticket->sold}}</p>
                <p>Published:{{$ticket->published}}</p>
                @if($ticket->order_id)
                    <a class="mb-3" href="/orders/{{$ticket->trashed_order->id}}">Order: {{$ticket->trashed_order->id}}</a>
                @endif
                <p>Tickettype verkoopt verloopt van <strong>{{$ticket->trashed_ticket_type->sale_start_date}}</strong> tot <strong>{{$ticket->trashed_ticket_type->sale_end_date}}</strong>.</p>
                <p>Ticketverkoop loopt van <strong>{{$ticket->start_date}}</strong> tot <strong>{{$ticket->end_date}}</strong>.</p>
                <a class="btn btn-outline-primary" href="/tickets/{{$ticket->id}}/edit" role="button"><i class="far fa-edit"></i> Edit</a>
                <form action="/tickets/{{$ticket->id}}" method="POST" class="d-inline-block pr-1">
                    @method('DELETE')
                    @csrf
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#softDeleteModal-{{$ticket->id}}"><i class="fas fa-minus-circle"></i>Soft Delete</button>
                    @component('components.softdelete-modal')
                        @slot('id')
                            {{$ticket->id}}
                        @endslot
                        @slot('datatype')
                            ticket
                        @endslot
                        @slot('name')
                            {{ $ticket->trashed_ticket_type->name }}
                        @endslot
                    @endcomponent
                </form>
                <form action="/tickets/{{$ticket->id}}/delete" method="POST" class="d-inline-block">
                    @method('DELETE')
                    @csrf
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#hardDeleteModal-{{$ticket->id}}"><i class="fas fa-trash"></i> Hard delete</button>
                    @component('components.harddelete-modal')
                        @slot('id')
                            {{$ticket->id}}
                        @endslot
                        @slot('datatype')
                            ticket
                        @endslot
                        @slot('name')
                            {{ $ticket->trashed_ticket_type->name }}
                        @endslot
                    @endcomponent
                </form>
            </div>
        </div>
    @endif
@endsection