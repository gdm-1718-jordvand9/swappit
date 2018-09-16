
@extends('layouts.app')

@section('content')
    @if($user->deleted_at)
        <div class="card border-danger">
            <div class="card-header text-danger">
                User
                <a href="/users" class="float-right text-danger"><i class="fas fa-list-ul"></i></a>
            </div>

            <div class="card-body">
                <h4>{{ $user->name }}</h4>
                <p>{{ $user->email }}</p>
                <p>Created: {{ $user->created_at->toDateTimeString() }}</p>
                <p>This user is <strong>{{ $user->verified() ? 'verified' : 'not verified' }}.</strong></p>
                <div>
                    <a class="btn btn-outline-danger" href="/users/{{$user->id}}/edit" role="button"><i class="far fa-edit"></i> Edit</a>
                    <form action="/users/{{$user->id}}/restore" method="POST" class="d-inline-block pr-1">
                        @method('PATCH')
                        @csrf
                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#restoreModal-{{$user->id}}"><i class="fas fa-plus-circle"></i> Restore</button>
                        @component('components.restore-modal')
                            @slot('id')
                                {{$user->id}}
                            @endslot
                            @slot('datatype')
                                user
                            @endslot
                            @slot('name')
                                {{ $user->name }}
                            @endslot
                        @endcomponent
                    </form>
                    <form action="/users/{{$user->id}}/delete" method="POST" class="d-inline-block">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#hardDeleteModal-{{$user->id}}"><i class="fas fa-trash"></i> Hard delete</button>
                        @component('components.harddelete-modal')
                            @slot('id')
                                {{$user->id}}
                            @endslot
                            @slot('datatype')
                                user
                            @endslot
                            @slot('name')
                                {{ $user->name }}
                            @endslot
                        @endcomponent
                    </form>
                    @if(!$user->verified())
                        <form action="/users/{{$user->id}}/verify" method="POST" class="d-inline-block">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-check-circle"></i> Verify user</button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card text-white bg-danger mt-3">
                    <div class="card-body">
                        <h1 class="card-title">{{ $ticketCount }}</h1>
                        <p>Tickets</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card text-white bg-danger mt-3">
                    <div class="card-body">
                        <h1 class="card-title">{{ $orderCount }}</h1>
                        <p>Orders</p>
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
            <div class="card-header">
                User
                <a href="/users" class="float-right text-primary"><i class="fas fa-list-ul"></i></a>
            </div>

            <div class="card-body">
                <h4>{{ $user->name }}</h4>
                <p>{{ $user->email }}</p>
                <p>Created: {{ $user->created_at->toDateTimeString() }}</p>
                <p>This user is <strong>{{ $user->verified() ? 'verified' : 'not verified' }}.</strong></p>
                <div>
                    <a class="btn btn-outline-primary" href="/users/{{$user->id}}/edit" role="button"><i class="far fa-edit"></i> Edit</a>
                    <form action="/users/{{$user->id}}" method="POST" class="d-inline-block pr-1">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#softDeleteModal-{{$user->id}}"><i class="fas fa-minus-circle"></i>Soft Delete</button>
                        <!-- Modal -->
                        @component('components.softdelete-modal')
                            @slot('id')
                                {{$user->id}}
                            @endslot
                            @slot('datatype')
                                user
                            @endslot
                            @slot('name')
                                {{ $user->name }}
                            @endslot
                        @endcomponent
                    </form>
                    <form action="/users/{{$user->id}}/delete" method="POST" class="d-inline-block">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#hardDeleteModal-{{$user->id}}"><i class="fas fa-trash"></i> Hard delete</button>
                        @component('components.harddelete-modal')
                            @slot('id')
                                {{$user->id}}
                            @endslot
                            @slot('datatype')
                                user
                            @endslot
                            @slot('name')
                                {{ $user->name }}
                            @endslot
                        @endcomponent
                    </form>
                    @if(!$user->verified())
                        <form action="/users/{{$user->id}}/verify" method="POST" class="d-inline-block">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-outline-primary"><i class="fas fa-check-circle"></i> Verify user</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card text-white bg-primary mt-3">
                    <div class="card-body">
                        <h1 class="card-title">{{ $ticketCount }}</h1>
                        <p>Tickets</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card text-white bg-primary mt-3">
                    <div class="card-body">
                        <h1 class="card-title">{{ $orderCount }}</h1>
                        <p>Orders</p>
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