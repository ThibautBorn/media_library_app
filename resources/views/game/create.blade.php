@extends('layout')
@section('content')
    <meta name="csrf-token" value="{{ csrf_token() }}">
    <div class="container">

        <H1>formulier</H1>
        <form method="POST" action="{{ route('create_game') }}">
            @csrf

            @if (Session::has('message'))
                <div class="alert alert-danger">{{ Session::get('message') }}</div>
            @endif

            <div class="form-group @if ($errors->has('name')) has-danger @endif">
                <label for="name" class="form-control-label">titel:</label>
                <input type="text" class="form-control form-control-danger{{ $errors->has('name') ? ' is-invalid' : '' }}"name="name" value="{{old('name')}}">
                @if ($errors->has('name')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('name') }}</p> @endif
            </div>

            <div class="form-group @if ($errors->has('year')) has-danger @endif">
                <label for="year" class="form-control-label" > jaar van uitgave</label><br>
                <input type="number" class="form-control form-control-danger{{ $errors->has('year') ? ' is-invalid' : '' }}"name="year" value="{{old('year')}}">
                @if ($errors->has('year')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('year') }}</p> @endif
            </div>

            <div class="form-group @if ($errors->has('platform')) has-danger @endif">
                <label for="platform" class="form-control-label" > Kies een (primaire) console voor het spel</label><br>
                <select name="platform" class="form-control" style="width:250px">
                    <option value="">--- Selecteer console ---</option>
                    @foreach ($platforms as $platform)
                        <option value="{{ $platform->id }}" {{ old("platform") == $platform->id ? "selected":""}}>{{ $platform->name}}</option>
                    @endforeach
                </select><br>
                @if ($errors->has('platform')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('platform') }}</p> @endif
            </div>

            <input type="checkbox" id="wishCheck" name="on_wishlist" value="1" onclick="myFunction()" checked>
            <label for="on_wishlist"> Moet dit spel op de wishlist komen?</label><br>

            <div id="text" style="display:none">
                <div class="form-group @if ($errors->has('score')) has-danger @endif">
                    <label for="score" class="form-control-label">score</label>
                    <input type="double" class="form-control form-control-danger{{ $errors->has('score') ? ' is-invalid' : '' }}"name="score" value="{{old('score')}}">
                    @if ($errors->has('score')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('score') }}</p> @endif
                </div>

                <div class="form-group @if ($errors->has('art_url')) has-danger @endif">
                    <label for="art_url" class="form-control-label">link naar de gewenste omslagfoto</label>
                    <input type="text" class="form-control form-control-danger{{ $errors->has('art_url') ? ' is-invalid' : '' }}"name="art_url" value="{{old('art_url')}}">
                    @if ($errors->has('art_url')) <p style="color:darkred;font-size:80%;" >{{ $errors->first('art_url') }}</p> @endif
                </div>
            </div>

            <script>
                function myFunction() {
                    var checkBox = document.getElementById("wishCheck");
                    var text = document.getElementById("text");
                    if (checkBox.checked == true){
                        text.style.display = "none";
                    } else {
                        text.style.display = "block";
                    }
                }
            </script>

            <button class="btn btn-primary" name="submit"  value="save">sla op</button><br>
        </form>
    </div>
@endsection
