@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('advertises') }}" method="post">
            {!! csrf_field() !!}
            @include('advertises.form')
        </form>
    </div>
@endsection