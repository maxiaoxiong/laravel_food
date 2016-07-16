@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('typefours') }}" method="post">
            {!! csrf_field() !!}
            @include('typefours.form')
        </form>
    </div>
@endsection