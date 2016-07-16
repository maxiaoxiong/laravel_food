@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('typethrees') }}" method="post">
            {!! csrf_field() !!}
            @include('typethrees.form')
        </form>
    </div>
@endsection