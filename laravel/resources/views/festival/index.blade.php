
@extends('layouts.app')

@section('content')
    @component('components.alert')
    @endcomponent
    <div class="card">
        <div class="card-header">
            Festivals
            <a href="festivals/create" class="float-right"><i class="fas fa-plus-circle"></i></a>
        </div>
        <div class="card-body">
            List of all festivals.
        </div>
    </div>
    <table class="table table-hover mt-3">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Start_date</th>
            <th scope="col">End_date</th>
            <th scope="col"><i class="fas fa-cog"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach($festivals as $festival)
            @if($festival->deleted_at)
                <tr class="table-danger" >
                    <th scope="row"><a class="text-danger" href="/festivals/{{$festival->id}}">{{$festival->id}}</a></th>
                    <td>{{$festival->name}}</td>
                    <td>{{$festival->start_date }}</td>
                    <td>{{$festival->end_date}}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="/festivals/{{$festival->id}}/edit" class="text-danger pr-1"><i class="far fa-edit"></i></a>
                            <form action="/festivals/{{$festival->id}}/restore" method="POST" class="d-inline-block pr-1">
                                @method('PATCH')
                                @csrf
                                <button type="button" class="text-primary btn btn-link p-0 text-danger" data-toggle="modal" data-target="#restoreModal-{{$festival->id}}"><i class="fas fa-plus-circle"></i></button>
                                @component('components.restore-modal')
                                    @slot('id')
                                        {{$festival->id}}
                                    @endslot
                                    @slot('datatype')
                                        festival
                                    @endslot
                                    @slot('name')
                                        {{ $festival->name }}
                                    @endslot
                                @endcomponent
                            </form>
                            <form action="/festivals/{{$festival->id}}/delete" method="POST" class="d-inline-block">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="text-primary btn btn-link p-0 text-danger" data-toggle="modal" data-target="#hardDeleteModal-{{$festival->id}}"><i class="fas fa-trash"></i></button>
                                @component('components.harddelete-modal')
                                    @slot('id')
                                        {{$festival->id}}
                                    @endslot
                                    @slot('datatype')
                                        festival
                                    @endslot
                                    @slot('name')
                                        {{ $festival->name }}
                                    @endslot
                                @endcomponent
                            </form>
                        </div>
                    </td>
                </tr>
            @else
                <tr>
                    <th scope="row"><a class="text-primary" href="/festivals/{{$festival->id}}">{{$festival->id}}</a></th>
                    <td>{{$festival->name}}</td>
                    <td>{{$festival->start_date }}</td>
                    <td>{{$festival->end_date}}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="/festivals/{{$festival->id}}/edit" class="text-primary pr-1"><i class="far fa-edit"></i></a>
                            <form action="/festivals/{{$festival->id}}" method="POST" class="d-inline-block pr-1">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="text-primary btn btn-link p-0 text-primary" data-toggle="modal" data-target="#softDeleteModal-{{$festival->id}}"><i class="fas fa-minus-circle"></i></button>
                                @component('components.softdelete-modal')
                                    @slot('id')
                                        {{$festival->id}}
                                    @endslot
                                    @slot('datatype')
                                        festival
                                    @endslot
                                    @slot('name')
                                        {{ $festival->name }}
                                    @endslot
                                @endcomponent
                            </form>
                            <form action="/festivals/{{$festival->id}}/delete" method="POST" class="d-inline-block">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="text-primary btn btn-link p-0 text-primary" data-toggle="modal" data-target="#hardDeleteModal-{{$festival->id}}"><i class="fas fa-trash"></i></button>
                                @component('components.harddelete-modal')
                                    @slot('id')
                                        {{$festival->id}}
                                    @endslot
                                    @slot('datatype')
                                        festival
                                    @endslot
                                    @slot('name')
                                        {{ $festival->name }}
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

@endsection