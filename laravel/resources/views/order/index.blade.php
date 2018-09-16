@extends('layouts.app')

@section('content')
    @component('components.alert')

    @endcomponent
    <meta id ="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <div class="card">
        <div class="card-header">
            Orders
            {{--<a href="orders/create" class="float-right"><i class="fas fa-plus-circle"></i></a>--}}
        </div>
        <div class="card-body">
            List of all orders.
        </div>
    </div>
    <table class="table table-hover mt-3">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Status</th>
            <th scope="col">Price</th>
            <th scope="col">User</th>
            <th scope="col">Placed</th>
            <th scope="col"><i class="fas fa-cog"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            @if($order->deleted_at)
                <tr class="table-danger">
                    <th scope="row"><a class="text-danger" href="/orders/{{$order->id}}">{{$order->id}}</a></th>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->trashed_user->name }}</td>
                    <td>{{ $order->placed_at }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            {{--<a href="/orders/{{$order->id}}/edit" class="text-danger pr-1"><i class="far fa-edit"></i></a>--}}
                            <form action="/orders/{{$order->id}}/restore" method="POST" class="d-inline-block pr-1">
                                @method('PATCH')
                                @csrf
                                <button type="button" class="text-primary btn btn-link p-0 text-danger" data-toggle="modal" data-target="#restoreModal-{{$order->id}}"><i class="fas fa-plus-circle"></i></button>
                                @component('components.restore-modal')
                                    @slot('id')
                                        {{$order->id}}
                                    @endslot
                                    @slot('datatype')
                                        order
                                    @endslot
                                    @slot('name')
                                        {{ $order->id }}
                                    @endslot
                                @endcomponent
                            </form>
                            <form action="/orders/{{$order->id}}/delete" method="POST" class="d-inline-block">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="text-primary btn btn-link p-0 text-danger" data-toggle="modal" data-target="#hardDeleteModal-{{$order->id}}"><i class="fas fa-trash"></i></button>
                                @component('components.harddelete-modal')
                                    @slot('id')
                                        {{$order->id}}
                                    @endslot
                                    @slot('datatype')
                                        order
                                    @endslot
                                    @slot('name')
                                        {{ $order->name }}
                                    @endslot
                                @endcomponent
                            </form>
                        </div>
                    </td>
                </tr>
            @else
                <tr>
                    <th scope="row" class="text-primary"><a href="/orders/{{$order->id}}">{{$order->id}}</a></th>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->trashed_user->name }}</td>
                    <td>{{ $order->placed_at->toDateTimeString() }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            {{--<a href="/orders/{{$order->id}}/edit" class="text-primary pr-1"><i class="far fa-edit"></i></a>--}}
                            <form action="/orders/{{$order->id}}" method="POST" class="d-inline-block pr-1">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="text-primary btn btn-link p-0 text-primary" data-toggle="modal" data-target="#softDeleteModal-{{$order->id}}"><i class="fas fa-minus-circle"></i></button>
                                @component('components.softdelete-modal')
                                    @slot('id')
                                        {{$order->id}}
                                    @endslot
                                    @slot('datatype')
                                        order
                                    @endslot
                                    @slot('name')
                                        {{ $order->name }}
                                    @endslot
                                @endcomponent
                            </form>
                            <form action="/orders/{{$order->id}}/delete" method="POST" class="d-inline-block">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="text-primary btn btn-link p-0 text-primary" data-toggle="modal" data-target="#hardDeleteModal-{{$order->id}}"><i class="fas fa-trash"></i></button>
                                @component('components.harddelete-modal')
                                    @slot('id')
                                        {{$order->id}}
                                    @endslot
                                    @slot('datatype')
                                        order
                                    @endslot
                                    @slot('name')
                                        {{ $order->name }}
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
        {{$orders->links()}}
    </div>


@endsection