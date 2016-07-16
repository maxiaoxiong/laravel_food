@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('typetwos') }}" method="post">
            {!! csrf_field() !!}
            @include('typetwos.form')
        </form>
    </div>
@endsection