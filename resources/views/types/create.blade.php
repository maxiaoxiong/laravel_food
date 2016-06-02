@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('types') }}" method="post">
            {!! csrf_field() !!}
            @include('types.form')
        </form>
    </div>
@endsection