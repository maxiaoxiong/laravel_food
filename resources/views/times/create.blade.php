@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('times') }}" method="post">
            {!! csrf_field() !!}
            @include('times.form')
        </form>
    </div>
@endsection