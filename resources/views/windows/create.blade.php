@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('windows') }}" method="post">
            {!! csrf_field() !!}
            @include('windows.form')
        </form>
    </div>
@endsection