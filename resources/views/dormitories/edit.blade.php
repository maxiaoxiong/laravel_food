@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('dormitories/'.$dormitory->id) }}" method="post">
            <input type="hidden" name="_method" value="put">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @include('dormitories.form')
        </form>
    </div>
@endsection