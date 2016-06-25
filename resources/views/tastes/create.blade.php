@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('tastes') }}" method="post">
            {!! csrf_field() !!}
            @include('tastes.form')
        </form>
    </div>
@endsection