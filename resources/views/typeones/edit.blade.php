@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('typeones/'.$typeone->id) }}" method="post">
            <input name="_method" type="hidden" value="put">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @include('typeones.form')
        </form>
    </div>
@endsection