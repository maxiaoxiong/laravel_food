@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('canteens/'.$canteen->id) }}" method="post">
            <input name="_method" type="hidden" value="put">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @include('canteens.form')
        </form>
    </div>
@endsection