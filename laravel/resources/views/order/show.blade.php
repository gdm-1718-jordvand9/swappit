@extends('layouts.app')

@section('content')
    @if($order->deleted_at)

        <div class="card border-danger">
            <div class="card-header text-danger">
                Order
                <a href="/orders" class="float-right text-danger"><i
                            class="fas fa-list-ul"></i></a>
            </div>
            <div class="card-body">
                <h5>User: {{$order->trashed_user->name}}</h5>
                <p>Status: <strong>{{$order->status}}</strong></p>
                <p>Price : €{{$order->price}}</p>
                <p>{{$order->description}}</p>
                <p>Placed: {{$order->placed_at ? $order->placed_at : '-'}}</p>
                <p>Payed: {{$order->payed_at ? $order->payed_at : '-'}}</p>
                <p>Cancelled: {{$order->cancelled_at ? $order->cancelled_at : '-'}}</p>
                <p>Completed: {{$order->completed_at ? $order->completed_at : '-'}}</p>
                @foreach($order->trashed_tickets as $ticket)
                    <a class="d-block mb-1" href="/tickets/{{$ticket->id}}">#{{ $ticket->id }} - {{ $ticket->trashed_ticket_type->trashed_festival->name }} - {{$ticket->trashed_ticket_type->name}}</a>
                @endforeach
                <div class="mt-3">
                    {{--<a class="btn btn-outline-danger"
                       href="/orders/{{$order->id}}/edit" role="button"><i class="far fa-edit"></i> Edit</a>--}}
                    <form action="/orders/{{$order->id}}/restore" method="POST" class="d-inline-block pr-1">
                        @method('PATCH')
                        @csrf
                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#restoreModal-{{$order->id}}"><i class="fas fa-plus-circle"></i> Restore</button>
                        @component('components.restore-modal')
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
                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#hardDeleteModal-{{$order->id}}"><i class="fas fa-trash"></i> Hard delete</button>
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
                    @if(!$order->completed_at || !$order->placed_at || !$order->cancelled_at || !$order->status === 'completed' || !$order->status === 'payed' || !$order->status === 'cancelled')
                        <form action="/orders/{{$order->id}}/cancel" method="POST" class="d-inline-block">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-ban"></i> Cancel</button>
                        </form>
                    @endif
                    @if(!$order->cancelled_at || !$order->completed_at || !$order->status->cancelled || !$order->status->completed )
                        <form action="/orders/{{$order->id}}/complete" method="POST" class="d-inline-block">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-check-circle"></i> Complete</button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    @else
        <div class="card">
            <div class="card-header">
                Order
                <a href="/orders" class="float-right text-primary"><i
                            class="fas fa-list-ul"></i></a>
            </div>
            <div class="card-body">
                <h5>User: {{$order->trashed_user->name}}</h5>
                <p>Status: <strong>{{$order->status}}</strong></p>
                <p>Price : €{{$order->price}}</p>
                <p>{{$order->description}}</p>
                <p>Placed: {{$order->placed_at ? $order->placed_at : '-'}}</p>
                <p>Payed: {{$order->payed_at ? $order->payed_at : '-'}}</p>
                <p>Cancelled: {{$order->cancelled_at ? $order->cancelled_at : '-'}}</p>
                <p>Completed: {{$order->completed_at ? $order->completed_at : '-'}}</p>
                @foreach($order->trashed_tickets as $ticket)
                    <a class=" d-block mb-1" href="/tickets/{{$ticket->id}}">#{{ $ticket->id }} - {{ $ticket->trashed_ticket_type->trashed_festival->name }} - {{$ticket->trashed_ticket_type->name}}</a>
                @endforeach
                <div class="mt-3">
                    {{--<a class="btn btn-outline-primary"
                       href="/orders/{{$order->id}}/edit" role="button"><i class="far fa-edit"></i> Edit</a>--}}
                    <form action="/orders/{{$order->id}}" method="POST" class="d-inline-block pr-1">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#softDeleteModal-{{$order->id}}"><i class="fas fa-minus-circle"></i>Soft Delete</button>
                        <!-- Modal -->
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
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#hardDeleteModal-{{$order->id}}"><i class="fas fa-trash"></i> Hard delete</button>
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
                    @if( !isset($order->completed_at) || isset($order->payed_at) || !isset($order->cancelled_at) || !$order->status === 'cancelled' || !$order->status === 'completed' || !$order->status === 'payed')
                        <form action="/orders/{{$order->id}}/cancel" method="POST" class="d-inline-block">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-outline-primary"><i class="fas fa-ban"></i> Cancel</button>
                        </form>
                    @endif
                    @if(isset($order->completed_at) || !$order->status === 'completed' || !isset($order->cancelled_at) || !$order->status === 'completed')
                        <form action="/orders/{{$order->id}}/complete" method="POST" class="d-inline-block">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn btn-outline-primary"><i class="fas fa-check-circle"></i> Complete</button>
                        </form>
                    @endif
                </div>


            </div>
        </div>
    @endif
@endsection