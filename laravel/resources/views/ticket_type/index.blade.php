@extends('layouts.app')

@section('content')
    @component('components.alert')
    @endcomponent
    <div class="card">
        <div class="card-header">
            Ticket Types
            <a href="ticket_types/create" class="float-right"><i class="fas fa-plus-circle"></i></a>
        </div>
        <div class="card-body">
            List of all ticket types.
        </div>
    </div>
    <table class="table table-hover mt-3">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Festival</th>
            <th scope="col">Ticket</th>
            <th scope="col">Price</th>
            <th scope="col">Sale open</th>
            <th scope="col"><i class="fas fa-cog"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach($ticket_types as $ticket_type)
            @if($ticket_type->deleted_at)
                <tr class="table-danger">
                    <th scope="row"><a class="text-danger" href="/ticket_types/{{$ticket_type->id}}">{{$ticket_type->id}}</a></th>
                    <td>{{$ticket_type->trashed_festival->name}}</td>
                    <td>{{$ticket_type->name}}</td>
                    <td>{{$ticket_type->price}}</td>
                    <td>{{$ticket_type->IsSaleOpen()}}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="/ticket_types/{{$ticket_type->id}}/edit" class="text-danger pr-1" title="Edit"><i class="far fa-edit"></i></a>
                            <form action="/ticket_types/{{$ticket_type->id}}/restore" method="POST" class="d-inline-block pr-1">
                                @method('PATCH')
                                @csrf
                                <button type="button" class="text-primary btn btn-link p-0 text-danger" data-toggle="modal" data-target="#restoreModal-{{$ticket_type->id}}"><i class="fas fa-plus-circle"></i></button>
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
                                <button type="button" class="text-primary btn btn-link p-0 text-danger" data-toggle="modal" data-target="#hardDeleteModal-{{$ticket_type->id}}"><i class="fas fa-trash"></i></button>
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
                    </td>
                </tr>
            @else
                <tr>
                    <th scope="row"><a class="text-primary" href="/ticket_types/{{$ticket_type->id}}">{{$ticket_type->id}}</a></th>
                    <td>{{$ticket_type->trashed_festival->name}}</td>
                    <td>{{$ticket_type->name}}</td>
                    <td>{{$ticket_type->price}}</td>
                    <td>{{$ticket_type->IsSaleOpen()}}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="/ticket_types/{{$ticket_type->id}}/edit" class="text-primary pr-1" title="Edit"><i class="far fa-edit"></i></a>
                            <form action="/ticket_types/{{$ticket_type->id}}" method="POST" class="d-inline-block pr-1">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="text-primary btn btn-link p-0 text-primary" data-toggle="modal" data-target="#softDeleteModal-{{$ticket_type->id}}"><i class="fas fa-minus-circle"></i></button>
                                @component('components.softdelete-modal')
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
                                <button type="button" class="text-primary btn btn-link p-0 text-primary" data-toggle="modal" data-target="#hardDeleteModal-{{$ticket_type->id}}"><i class="fas fa-trash"></i></button>
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
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {{$ticket_types->links()}}
    </div>

@endsection