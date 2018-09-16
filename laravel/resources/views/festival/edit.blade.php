@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Update a festival
            <a href="/festivals" class="float-right"><i class="fas fa-list-ul"></i></a>
        </div>
        <div class="card-body">
            <form action="/festivals/{{$festival->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row form-group">
                    <div class="col">
                        <label for="name">Festival Name</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" value="{{old('name', $festival->name)}}">
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{$errors->first('name')}}
                            </div>
                        @endif
                    </div>
                    <div class="col">
                        <label for="place">Place</label>
                        <input type="text" class="form-control {{ $errors->has('place') ? 'is-invalid' : ''}}" id="place" name="place" value="{{old('place', $festival->place)}}">
                        @if($errors->has('place'))
                            <div class="invalid-feedback">
                                {{$errors->first('place')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col">
                        <label for="description">Description</label>
                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : ''}}" id="description" rows="3" name="description">{{old('description', $festival->description)}}</textarea>
                        @if($errors->has('description'))
                            <div class="invalid-feedback">
                                {{$errors->first('description')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col">
                        <label for="start_date">Festival start date</label>
                        <input class="form-control {{ $errors->has('start_date') ? 'is-invalid' : ''}}" type="date" value="{{old('start_date', $festival->start_date)}}" id="start_date" name="start_date">
                        @if($errors->has('start_date'))
                            <div class="invalid-feedback">
                                {{$errors->first('start_date')}}
                            </div>
                        @endif
                    </div>
                    <div class="col">
                        <label for="end_date">Festival end date</label>
                        <input class="form-control {{ $errors->has('end_date') ? 'is-invalid' : ''}}" type="date" value="{{old('end_date', $festival->end_date)}}" id="end_date" name="end_date">
                    </div>
                    @if($errors->has('end_date'))
                        <div class="invalid-feedback">
                            {{$errors->first('end_date')}}
                        </div>
                    @endif
                </div>
                <div class="form-row form-group">
                    <div class="col">
                        <label for="facebook_url">Facebook url</label>
                        <input type="text" class="form-control {{ $errors->has('facebook_url') ? 'is-invalid' : ''}}" id="facebook_url" name="facebook_url" value="{{old('facebook_url', $festival->facebook_url)}}">
                        @if($errors->has('facebook_url'))
                            <div class="invalid-feedback">
                                {{$errors->first('facebook_url')}}
                            </div>
                        @endif
                    </div>
                    <div class="col">
                        <label for="twitter_url">Twitter url</label>
                        <input type="text" class="form-control {{ $errors->has('twitter_url') ? 'is-invalid' : ''}}" id="twitter_url" name="twitter_url" value="{{old('twitter_url', $festival->twitter_url)}}">
                        @if($errors->has('twitter_url'))
                            <div class="invalid-feedback">
                                {{$errors->first('twitter_url')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col">
                        <label for="instagram_url">Instagram url</label>
                        <input type="text" class="form-control {{ $errors->has('instagram_url') ? 'is-invalid' : ''}}" id="instagram_url" name="instagram_url" value="{{old('instagram_url', $festival->instagram_url)}}">
                        @if($errors->has('instagram_url'))
                            <div class="invalid-feedback">
                                {{$errors->first('instagram_url')}}
                            </div>
                        @endif
                    </div>
                    <div class="col">
                        <label for="snapchat_url">Snapchat url</label>
                        <input type="text" class="form-control {{ $errors->has('snapchat_url') ? 'is-invalid' : ''}}" id="snapchat_url" name="snapchat_url" value="{{old('snapchat_url', $festival->snapchat_url)}}">
                        @if($errors->has('snapchat_url'))
                            <div class="invalid-feedback">
                                {{$errors->first('snapchat_url')}}
                            </div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

@endsection