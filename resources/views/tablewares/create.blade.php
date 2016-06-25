@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('tablewares') }}" method="post">
            {!! csrf_field() !!}
            @include('tablewares.form')
        </form>
    </div>
@endsection