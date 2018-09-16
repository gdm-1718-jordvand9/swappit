@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Edit a ticket type
            <a href="/ticket_types" class="float-right"><i class="fas fa-list-ul"></i></a>
        </div>
        <div class="card-body">
            <form action="/ticket_types/{{$ticket_type->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row form-group">
                    <div class="col">
                        <label for="name">Ticket Type Name</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" value="{{old('name', $ticket_type->name)}}">
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{$errors->first('name')}}
                            </div>
                        @endif
                    </div>
                    <div class="col">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" class="form-control {{ $errors->has('price') ? 'is-invalid' : ''}}" id="price" name="price" value="{{old('price', $ticket_type->price)}}">
                        @if($errors->has('price'))
                            <div class="invalid-feedback">
                                {{$errors->first('price')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col">
                        <label for="festival">Festival</label>
                        <select class="form-control {{ $errors->has('festival') ? 'is-invalid' : ''}}" id="festival" name="festival">

                            @foreach($festivals as $id => $name)
                                @if(old('festival'))
                                <option value="{{ $id }}" {{ (old("festival") == $id ? "selected":"") }}>{{ $name }}</option>
                                @else
                                    <option value="{{ $id }}" {{ $ticket_type->festival_id == $id ? "selected":"" }}>{{ $name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if($errors->has('festival'))
                            <div class="invalid-feedback">
                                {{$errors->first('festival')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col">
                        <label for="description">Description</label>
                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : ''}}" id="description" rows="3" name="description">{{old('description', $ticket_type->description)}}</textarea>
                        @if($errors->has('description'))
                            <div class="invalid-feedback">
                                {{$errors->first('description')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col">
                        <label for="sale_start_date">Sale start date</label>
                        <input class="form-control {{ $errors->has('sale_start_date') ? 'is-invalid' : ''}}" type="date" value="{{old('sale_start_date', $ticket_type->sale_start_date)}}" id="sale_start_date" name="sale_start_date">
                        @if($errors->has('sale_start_date'))
                            <div class="invalid-feedback">
                                {{$errors->first('sale_start_date')}}
                            </div>
                        @endif
                    </div>
                    <div class="col">
                        <label for="sale_end_date">Sale end date</label>
                        <input class="form-control {{ $errors->has('sale_end_date') ? 'is-invalid' : ''}}" type="date" value="{{old('sale_end_date', $ticket_type->sale_end_date)}}" id="sale_end_date" name="sale_end_date">
                        @if($errors->has('sale_end_date'))
                            <div class="invalid-feedback">
                                {{$errors->first('sale_end_date')}}
                            </div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

@endsection