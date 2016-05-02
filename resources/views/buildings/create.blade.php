@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('buildings') }}" method="post">
            {!! csrf_field() !!}
            @include('buildings.form')
        </form>
    </div>
@endsection