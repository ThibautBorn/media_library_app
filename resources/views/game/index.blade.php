@extends('layout')
@section('content')

<div class="container" id="root">
    <game-table :games="games"/>
</div>
<script src="https://unpkg.com/vue@2.6.11/dist/vue.js" ></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="js/modal.js" ></script>
@endsection
