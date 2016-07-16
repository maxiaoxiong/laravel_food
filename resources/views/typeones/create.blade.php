@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('typeones') }}" method="post">
            {!! csrf_field() !!}
            @include('typeones.form')
        </form>
    </div>
@endsection