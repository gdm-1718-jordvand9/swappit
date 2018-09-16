@extends('layouts.app')

@section('content')
    @component('components.alert')
    @endcomponent
    <div class="card">
        <div class="card-header">
            Tickets
            <a href="tickets/create" class="float-right"><i class="fas fa-plus-circle"></i></a>
        </div>
        <div class="card-body">
            List of all tickets.
        </div>
    </div>
    <table class="table table-hover mt-3">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Festival</th>
            <th scope="col">Ticket</th>
            <th scope="col">User</th>
            <th scope="col">Sold</th>
            <th scope="col"><i class="fas fa-cog"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach($tickets as $ticket)
            @if($ticket->deleted_at)
                <tr class="table-danger">
                    <th scope="row"><a class="text-danger" href="/tickets/{{$ticket->id}}">{{$ticket->id}}</a></th>
                    <td>{{$ticket->trashed_ticket_type->trashed_festival->name}}</td>
                    <td>{{$ticket->trashed_ticket_type->name}}</td>
                    <td>{{$ticket->trashed_user->name}}</td>
                    <td>{{$ticket->sold}}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="/tickets/{{$ticket->id}}/edit" class="text-danger pr-1"><i class="far fa-edit"></i></a>
                            <form action="/tickets/{{$ticket->id}}/restore" method="POST" class="d-inline-block pr-1">
                                @method('PATCH')
                                @csrf
                                <button type="button" class="text-primary btn btn-link p-0 text-danger" data-toggle="modal" data-target="#restoreModal-{{$ticket->id}}"><i class="fas fa-plus-circle"></i></button>
                                @component('components.restore-modal')
                                    @slot('id')
                                        {{$ticket->id}}
                                    @endslot
                                    @slot('datatype')
                                        ticket
                                    @endslot
                                    @slot('name')
                                        {{ $ticket->name }}
                                    @endslot
                                @endcomponent
                            </form>
                            <form action="/tickets/{{$ticket->id}}/delete" method="POST" class="d-inline-block">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="text-primary btn btn-link p-0 text-danger" data-toggle="modal" data-target="#hardDeleteModal-{{$ticket->id}}"><i class="fas fa-trash"></i></button>
                                @component('components.harddelete-modal')
                                    @slot('id')
                                        {{$ticket->id}}
                                    @endslot
                                    @slot('datatype')
                                        ticket
                                    @endslot
                                    @slot('name')
                                        {{ $ticket->name }}
                                    @endslot
                                @endcomponent
                            </form>

                        </div>
                    </td>
                </tr>
            @else
                <tr>
                    <th scope="row"><a href="/tickets/{{$ticket->id}}">{{$ticket->id}}</a></th>
                    <td>{{$ticket->trashed_ticket_type->trashed_festival->name}}</td>
                    <td>{{$ticket->trashed_ticket_type->name}}</td>
                    <td>{{$ticket->trashed_user->name}}</td>
                    <td>{{$ticket->sold}}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="/tickets/{{$ticket->id}}/edit" class="text-primary pr-1" title="Edit"><i
                                        class="far fa-edit"></i></a>
                            <form action="/tickets/{{$ticket->id}}" method="POST" class="d-inline-block pr-1">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="text-primary btn btn-link p-0 text-primary" data-toggle="modal" data-target="#softDeleteModal-{{$ticket->id}}"><i class="fas fa-minus-circle"></i></button>
                                @component('components.softdelete-modal')
                                    @slot('id')
                                        {{$ticket->id}}
                                    @endslot
                                    @slot('datatype')
                                        ticket
                                    @endslot
                                    @slot('name')
                                        {{ $ticket->name }}
                                    @endslot
                                @endcomponent
                            </form>
                            <form action="/tickets/{{$ticket->id}}/delete" method="POST" class="d-inline-block">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="text-primary btn btn-link p-0 text-primary" data-toggle="modal" data-target="#hardDeleteModal-{{$ticket->id}}"><i class="fas fa-trash"></i></button>
                                @component('components.harddelete-modal')
                                    @slot('id')
                                        {{$ticket->id}}
                                    @endslot
                                    @slot('datatype')
                                        ticket
                                    @endslot
                                    @slot('name')
                                        {{ $ticket->name }}
                                    @endslot
                                @endcomponent
                            </form>
                        </div>

                    </td>
                </tr>
            @endif

        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {{$tickets->links()}}
    </div>

@endsection