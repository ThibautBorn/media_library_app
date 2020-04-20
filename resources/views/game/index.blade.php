@extends('layout')
@section('content')

<div class="container" >
    <table id="games" class="display">
        <thead>
        <tr>
            <th width="25%">Titel</th>
            <th width="25%">platform</th>
            <th width="25%">Eigen Score</th>
            <th width="25%">jaar</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($owned_games as $owned_game)
            <tr>
                <td><h3>{{$owned_game->name}}</h3></td>
                <td>{{$owned_game->owned_platform->name}}</td>
                <td>{{$owned_game->score}}</td>
                <td>{{$owned_game->art_url}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('#games').DataTable();
    } );



    $('#games').on( 'click', 'tbody tr', function () {
        console.log($(this.cells[0]))
        //window.location.href = 'see_games';
        //window.location.href = $(this).attr('titel');
    } );
</script>
@endsection
