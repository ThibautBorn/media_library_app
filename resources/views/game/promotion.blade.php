@extends('layout')
@section('content')
    <meta name="csrf-token" value="{{ csrf_token() }}">
    <div class="container">

        <H1>formulier</H1>
        <form method="POST" action="{{ route('own_game') }}">
            @csrf

            @if (Session::has('message'))
                <div class="alert alert-danger">{{ Session::get('message') }}</div>
            @endif

            <input type="text" name="id" value="{{$game->id}}" hidden>

            <label for="name" class="form-control-label">titel:</label>
            <input type="text" name="name" value="{{$game->name}}" disabled>

            <label for="year" class="form-control-label" > jaar van uitgave</label><br>
            <input type="number" name="year" value="{{$game->year}}" disabled>

            <label for="platform" class="form-control-label" > platform </label><br>
            <input type="text" name="year" value="{{$game->owned_platform->name}}" disabled>


            <div class="form-group @if ($errors->has('score')) has-danger @endif">
                <label for="score" class="form-control-label">score</label>
                <input type="double" class="form-control form-control-danger{{ $errors->has('score') ? ' is-invalid' : '' }}"name="score" value="{{old('score')}}">
                @if ($errors->has('score')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('score') }}</p> @endif
            </div>

            <div class="form-group @if ($errors->has('art_url')) has-danger @endif">
                <label for="art_url" class="form-control-label">link naar de gewenste omslagfoto</label>
                <input type="text" class="form-control form-control-danger{{ $errors->has('art_url') ? ' is-invalid' : '' }}"name="art_url" value="{{old('art_url')}}" required>
                @if ($errors->has('art_url')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('art_url') }}</p> @endif
            </div>

            <button class="btn btn-primary" name="submit"  value="save">promoveer</button><br>
        </form>
    </div>
@endsection
