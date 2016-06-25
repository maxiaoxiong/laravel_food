@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('dishtypes') }}" method="post">
            {!! csrf_field() !!}
            @include('dishtypes.form')
        </form>
    </div>
@endsection