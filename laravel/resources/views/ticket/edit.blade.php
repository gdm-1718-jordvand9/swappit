@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Create a ticket
            <a href="/tickets" class="float-right"><i class="fas fa-list-ul"></i></a>
        </div>
        <div class="card-body">
            <form action="/tickets/{{$ticket->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row form-group">
                    <div class="col">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" class="form-control {{ $errors->has('price') ? 'is-invalid' : ''}}" id="price" name="price" value="{{ $errors->has('price') ? old('price') : $ticket->price }}">
                        @if($errors->has('price'))
                            <div class="invalid-feedback">
                                {{$errors->first('price')}}
                            </div>
                        @endif
                    </div>
                    <div class="col">
                        <label for="user">Users</label>
                        <select class="form-control {{ $errors->has('user') ? 'is-invalid' : ''}}" id="user" name="user">
                            <option value="">Select a user</option>
                            @foreach($users as $userid => $username)
                                <option value="{{ $userid }}" @if($ticket->user_id == $userid) selected @endif>{{ $username }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('user'))
                            <div class="invalid-feedback">
                                {{$errors->first('user')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col">
                        <label for="start_date">Sale start date</label>
                        <input class="form-control {{ $errors->has('start_date') ? 'is-invalid' : ''}}" type="date" value="{{ $errors->has('start_date') ? old('start_date') : $ticket->start_date }}" id="start_date" name="start_date">
                        @if($errors->has('start_date'))
                            <div class="invalid-feedback">
                                {{$errors->first('start_date')}}
                            </div>
                        @endif
                    </div>
                    <div class="col">
                        <label for="end_date">Sale end date</label>
                        <input class="form-control {{ $errors->has('end_date') ? 'is-invalid' : ''}}" type="date" value="{{ $errors->has('end_date') ? old('end_date') : $ticket->end_date }}" id="end_date" name="end_date">
                        @if($errors->has('end_date'))
                            <div class="invalid-feedback">
                                {{$errors->first('end_date')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col">
                        <label for="festival">Festival</label>
                        <select class="form-control {{ $errors->has('festival') ? 'is-invalid' : ''}}" id="festival" name="festival">
                            <option value="">Select a festival</option>
                            @foreach($festivals as $id => $name)
                                <option value="{{ $id }}" @if($ticket->trashed_ticket_type->trashed_festival->id == $id) selected @endif>{{$name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('festival'))
                            <div class="invalid-feedback">
                                {{$errors->first('festival')}}
                            </div>
                        @endif
                    </div>
                    <div class="col">
                        <label for="tickettype">Ticket Type</label>
                        <select class="form-control {{ $errors->has('tickettype') ? 'is-invalid' : ''}}" id="tickettype" name="tickettype">

                        </select>
                        @if($errors->has('tickettype'))
                            <div class="invalid-feedback">
                                {{$errors->first('tickettype')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-row form-group form-check">
                    <div class="col">
                        <label class="form-check-label">
                            <input type="hidden" name="sold" value="0">
                            <input type="checkbox" class="form-check-input {{ $errors->has('sold') ? 'is-invalid' : ''}}" name="sold" value="1" {{ $errors->has('sold') ? (old('sold')== '1' ? 'checked' : '') : ($ticket->sold == '1' ? 'checked' : '') }}>
                            Sold
                        </label>
                        @if($errors->has('sold'))
                            <div class="invalid-feedback">
                                {{$errors->first('sold')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-row form-group form-check">
                    <div class="col">
                        <label class="form-check-label">
                            <input type="hidden" name="published" value="0">
                            <input type="checkbox" class="form-check-input {{ $errors->has('published') ? 'is-invalid' : ''}}" name="published" value="1" {{ $errors->has('sold') ? (old('published')== '1' ? 'checked' : '') : ($ticket->published == '1' ? 'checked' : '') }}>
                            Published
                        </label>
                        @if($errors->has('published'))
                            <div class="invalid-feedback">
                                {{$errors->first('published')}}
                            </div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var festivalDropdown = document.getElementById('festival');
            var tickettypeDropdown = document.getElementById("tickettype");
            var loadData = function() {
                tickettypeDropdown.innerHTML = '';
                var id = festivalDropdown.options[festivalDropdown.selectedIndex].value;
                console.log(id);
                // Json request
                var request = new XMLHttpRequest();
                request.open('GET', `/tickets/ddtickettypes/${id}`, true);

                request.onload = function () {
                    if(request.status >=200 && request.status < 400) {
                        // Success
                        var data = JSON.parse(request.responseText);
                        console.log(data);
                        for (var key in data)
                        {
                            var option = document.createElement('option');
                            option.value = key;
                            option.innerHTML = data[key];
                            if(key == '{{$ticket->ticket_type->id}}') {
                             option.selected = true
                            }
                            tickettypeDropdown.appendChild(option);
                        }
                    }
                    else {
                        // Error
                    }
                }
                request.onerror = function () {
                    // Connection error
                }
                request.send();
            }
            loadData();
            festivalDropdown.onchange = function() {

                tickettypeDropdown.innerHTML = '';
                var id = festivalDropdown.options[festivalDropdown.selectedIndex].value;
                // Json request
                var request = new XMLHttpRequest();
                request.open('GET', `/tickets/ddtickettypes/${id}`, true);

                request.onload = function () {
                    if(request.status >=200 && request.status < 400) {
                        // Success
                        var data = JSON.parse(request.responseText);
                        console.log(data);
                        for (var key in data)
                        {
                            var option = document.createElement('option');
                            option.value = key;
                            option.innerHTML = data[key];
                            tickettypeDropdown.appendChild(option);
                        }
                    }
                    else {
                        // Error
                    }
                }
                request.onerror = function () {
                    // Connection error
                }
                request.send();
            }
        });
    </script>

@endsection