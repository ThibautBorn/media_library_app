@extends('layout')
@section('content')
    <div class="container" >
        <table id="wishlist">
            <thead>
            <tr>
                <th width="5%">jaar</th>
                <th width="20%">game</th>
                <th width="15%">upgrade naar library</th>
                <th width="15%">verwijder</th>
            </tr>
            </thead>

            <tbody>
            @foreach($wishlist as $game)
                <tr>
                    <td>{{substr(($game->attributes["first_release_date"]),0,4)}}</td>
                    <td><a href={{$game->attributes['url']}}>{{$game->attributes["name"]}}</a></td>
                    <td>
                        <form action="{{ route('promote_game') }}" method="GET">
                            @csrf
                            <input name="name" type="hidden" value="{{$game->attributes["name"]}}">
                            <button type="submit" class="btn btn-info" title="view_company">upgrade <i class="material-icons">games</i></button>
                        </form>
                    </td>
                    <td>
                        <form action="" method="GET">
                            @csrf
                            <input name="id" type="hidden" value="{{$game->attributes["name"]}}">
                            <button type="submit" class="btn btn-info" title="view_company">delete <i class="material-icons">clear</i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#wishlist').DataTable();
            } );
        </script>

    </div>

@endsection

