@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('typetwos/'.$typetwo->id) }}" method="post">
            <input name="_method" type="hidden" value="put">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @include('typetwos.form')
        </form>
    </div>
@endsection