@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('canteens') }}" method="post">
            {!! csrf_field() !!}
            @include('canteens.form')
        </form>
    </div>
@endsection