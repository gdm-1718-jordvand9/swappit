@extends('layouts.app')

@section('content')
    @if($ticket_type->deleted_at)
    <div class="card border-danger">
        <div class="card-header text-danger">
            Ticket
            <a href="/ticket_types" class="float-right text-danger"><i class="fas fa-list-ul"></i></a>
        </div>
        <div class="card-body">
            <h5>{{$ticket_type->name}}</h5>
            <p>Festival: {{$ticket_type->festival->name}}</p>
            <p>Price: {{$ticket_type->price}}</p>
            {{--<p>Verkoop open: <strong class="{{$ticket_type->sale_open == 'true' ? 'text-success' : 'text-danger'}}">{{$ticket_type->sale_open}}</strong></p>--}}
            <p>{{$ticket_type->description}}</p>
            <p>Ticketverkoop loopt van <strong>{{$ticket_type->sale_start_date}}</strong> tot <strong>{{$ticket_type->sale_end_date}}</strong>.</p>
            <a class="btn btn-outline-danger" href="/ticket_types/{{$ticket_type->id}}/edit" role="button"><i class="far fa-edit"></i> Edit</a>
            <form action="/ticket_types/{{$ticket_type->id}}/restore" method="POST" class="d-inline-block pr-1">
                @method('PATCH')
                @csrf
                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#restoreModal-{{$ticket_type->id}}"><i class="fas fa-plus-circle"></i> Restore</button>
                @component('components.restore-modal')
                    @slot('id')
                        {{$ticket_type->id}}
                    @endslot
                    @slot('datatype')
                        ticket_type
                    @endslot
                    @slot('name')
                        {{ $ticket_type->name }}
                    @endslot
                @endcomponent
            </form>
            <form action="/ticket_types/{{$ticket_type->id}}/delete" method="POST" class="d-inline-block">
                @method('DELETE')
                @csrf
                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#hardDeleteModal-{{$ticket_type->id}}"><i class="fas fa-trash"></i> Hard delete</button>
                @component('components.harddelete-modal')
                    @slot('id')
                        {{$ticket_type->id}}
                    @endslot
                    @slot('datatype')
                        ticket_type
                    @endslot
                    @slot('name')
                        {{ $ticket_type->name }}
                    @endslot
                @endcomponent
            </form>
        </div>
    </div>
    @else
        <div class="card">
            <div class="card-header text-primary">
                Ticket
                <a href="/ticket_types" class="float-right text-primary"><i class="fas fa-list-ul"></i></a>
            </div>
            <div class="card-body">
                <h5>{{$ticket_type->name}}</h5>
                <p>Festival: {{$ticket_type->festival->name}}</p>
                <p>Price: {{$ticket_type->price}}</p>
                {{--<p>Verkoop open: <strong class="{{$ticket_type->sale_open == 'true' ? 'text-success' : 'text-danger'}}">{{$ticket_type->sale_open}}</strong></p>--}}
                <p>{{$ticket_type->description}}</p>
                <p>Ticketverkoop loopt van <strong>{{$ticket_type->sale_start_date}}</strong> tot <strong>{{$ticket_type->sale_end_date}}</strong>.</p>
                <a class="btn btn-outline-primary" href="/ticket_types/{{$ticket_type->id}}/edit" role="button"><i class="far fa-edit"></i> Edit</a>
                <form action="/ticket_types/{{$ticket_type->id}}" method="POST" class="d-inline-block pr-1">
                    @method('DELETE')
                    @csrf
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#softDeleteModal-{{$ticket_type->id}}"><i class="fas fa-minus-circle"></i>Soft Delete</button>
                    <!-- Modal -->
                    @component('components.softdelete-modal')
                        @slot('id')
                            {{$ticket_type->id}}
                        @endslot
                        @slot('datatype')
                            festival
                        @endslot
                        @slot('name')
                            {{ $ticket_type->name }}
                        @endslot
                    @endcomponent
                </form>
                <form action="/ticket_types/{{$ticket_type->id}}/delete" method="POST" class="d-inline-block">
                    @method('DELETE')
                    @csrf
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#hardDeleteModal-{{$ticket_type->id}}"><i class="fas fa-trash"></i> Hard delete</button>
                    @component('components.harddelete-modal')
                        @slot('id')
                            {{$ticket_type->id}}
                        @endslot
                        @slot('datatype')
                            festival
                        @endslot
                        @slot('name')
                            {{ $ticket_type->name }}
                        @endslot
                    @endcomponent
                </form>
            </div>
        </div>
    @endif
    {{--<div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card text-white bg-{{$color}} mt-3">
                <div class="card-body">
                    <h1 class="card-title">{{$totalSold}}</h1>
                    <p>Available</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card text-white bg-{{$color}} mt-3">
                <div class="card-body">
                    <h1 class="card-title">{{$totalAvailable}}</h1>
                    <p>Sold</p>
                </div>
            </div>

        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card text-white bg-{{$color}} mt-3">
                <div class="card-body">
                    <h1 class="card-title">6</h1>
                    <p>Wanted</p>
                </div>
            </div>

        </div>
    </div>--}}
@endsection