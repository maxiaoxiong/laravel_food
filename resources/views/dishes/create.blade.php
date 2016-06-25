@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('dishes') }}" method="post">
            @include('dishes.form')
        </form>
    </div>

    <script>
        getWindows(1);
    </script>
@endsection