@extends('layouts.app')

@section('content')
    @component('components.alert')

    @endcomponent
    <meta id ="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <div class="card">
        <div class="card-header">
            Users
            <a href="users/create" class="float-right"><i class="fas fa-plus-circle"></i></a>
        </div>
        <div class="card-body">
            List of all users.
        </div>
    </div>
    <table class="table table-hover mt-3">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Role</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Created</th>
            <th scope="col"><i class="fas fa-cog"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            @if($user->deleted_at)
                <tr class="table-danger">
                    <th scope="row"><a class="text-danger" href="/users/{{$user->id}}">{{$user->id}}</a></th>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->toDateTimeString() }}</td>
                    <td>
                        <div class="d-flex align-items-center justify-content-around">
                            <a href="/users/{{$user->id}}/edit" class="text-danger"><i class="far fa-edit"></i></a>
                            <form action="/users/{{$user->id}}/restore" method="POST" class="d-inline-block pr-1">
                                @method('PATCH')
                                @csrf
                                <button type="button" class="text-primary btn btn-link p-0 text-danger" data-toggle="modal" data-target="#restoreModal-{{$user->id}}"><i class="fas fa-plus-circle"></i></button>
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
                                <button type="button" class="text-primary btn btn-link p-0 text-danger" data-toggle="modal" data-target="#hardDeleteModal-{{$user->id}}"><i class="fas fa-trash"></i></button>
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
                        </div>
                    </td>
                </tr>
            @else
                <tr>
                    <th scope="row"><a  href="/users/{{$user->id}}">{{$user->id}}</a></th>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->toDateTimeString() }}</td>
                    <td>
                        <div class="d-flex align-items-center justify-content-around">
                            <a href="/users/{{$user->id}}/edit"><i class="far fa-edit"></i></a>
                            <form action="/users/{{$user->id}}" method="POST" class="d-inline-block pr-1">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="text-primary btn btn-link p-0 text-primary" data-toggle="modal" data-target="#softDeleteModal-{{$user->id}}"><i class="fas fa-minus-circle"></i></button>
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
                                <button type="button" class="text-primary btn btn-link p-0 text-primary" data-toggle="modal" data-target="#hardDeleteModal-{{$user->id}}"><i class="fas fa-trash"></i></button>
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
                        </div>
                    </td>
                </tr>
            @endif()
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {{$users->links()}}
    </div>


@endsection