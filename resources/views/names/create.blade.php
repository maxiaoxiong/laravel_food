@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('names') }}" method="post">
            {!! csrf_field() !!}
            @include('names.form')
        </form>
    </div>
@endsection