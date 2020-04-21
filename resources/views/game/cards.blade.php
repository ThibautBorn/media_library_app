@extends('layout')
@section('content')
    <div id="root" class="container">

        <game-card class="game-card" v-for="game in games" :game="game"></game-card>

    </div>
    <script src="https://unpkg.com/vue@2.6.11/dist/vue.js" ></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/main.js" ></script>
@endsection
