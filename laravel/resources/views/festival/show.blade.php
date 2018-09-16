@extends('layouts.app')

@section('content')
    @if($festival->deleted_at)

    <div class="card border-danger">
        <div class="card-header text-danger">
            Festival
            <a href="/festivals" class="float-right text-danger"><i
                        class="fas fa-list-ul"></i></a>
        </div>
        <div class="card-body">
            <h5>{{$festival->name}}</h5>
            <p>{{$festival->place}}</p>
            <p>{{$festival->description}}</p>
            <p>Festivalperiode loopt van <strong>{{$festival->start_date}}</strong> tot
                <strong>{{$festival->end_date}}</strong>.</p>
            <a class="btn btn-outline-danger"
               href="/festivals/{{$festival->id}}/edit" role="button"><i class="far fa-edit"></i> Edit</a>
            <form action="/festivals/{{$festival->id}}/restore" method="POST" class="d-inline-block pr-1">
                @method('PATCH')
                @csrf
                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#restoreModal-{{$festival->id}}"><i class="fas fa-plus-circle"></i> Restore</button>
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
                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#hardDeleteModal-{{$festival->id}}"><i class="fas fa-trash"></i> Hard delete</button>
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
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card text-white bg-danger mt-3">
                <div class="card-body">
                    <h1 class="card-title">2</h1>
                    <p>Available</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card text-white bg-danger mt-3">
                <div class="card-body">
                    <h1 class="card-title">3</h1>
                    <p>Sold</p>
                </div>
            </div>

        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card text-white bg-danger mt-3">
                <div class="card-body">
                    <h1 class="card-title">6</h1>
                    <p>Wanted</p>
                </div>
            </div>

        </div>
    </div>
    @else
        <div class="card">
            <div class="card-header text-primary">
                Festival
                <a href="/festivals" class="float-right text-primary"><i
                            class="fas fa-list-ul"></i></a>
            </div>
            <div class="card-body">
                <h5>{{$festival->name}}</h5>
                <p>{{$festival->place}}</p>
                <p>{{$festival->description}}</p>
                <p>Festivalperiode loopt van <strong>{{$festival->start_date}}</strong> tot
                    <strong>{{$festival->end_date}}</strong>.</p>
                <a class="btn btn-outline-primary"
                   href="/festivals/{{$festival->id}}/edit" role="button"><i class="far fa-edit"></i> Edit</a>
                <form action="/festivals/{{$festival->id}}" method="POST" class="d-inline-block pr-1">
                    @method('DELETE')
                    @csrf
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#softDeleteModal-{{$festival->id}}"><i class="fas fa-minus-circle"></i>Soft Delete</button>
                    <!-- Modal -->
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
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#hardDeleteModal-{{$festival->id}}"><i class="fas fa-trash"></i> Hard delete</button>
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
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card text-white bg-primary mt-3">
                    <div class="card-body">
                        <h1 class="card-title">2</h1>
                        <p>Available</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card text-white bg-primary mt-3">
                    <div class="card-body">
                        <h1 class="card-title">3</h1>
                        <p>Sold</p>
                    </div>
                </div>

            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card text-white bg-primary mt-3">
                    <div class="card-body">
                        <h1 class="card-title">6</h1>
                        <p>Wanted</p>
                    </div>
                </div>

            </div>
        </div>
    @endif
@endsection