@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('dormitories') }}" method="post">
            {!! csrf_field() !!}
            @include('dormitories.form')
        </form>
    </div>

    <script>
        getFloors(1);
    </script>
@endsection