@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('dishes') }}" method="post">
            @include('dishes.form')
        </form>
    </div>

    <script>
        {{ $arr = \App\Canteen::lists('id')->toArray() }}
        getWindows({{ $arr[rand(0,count($arr)-1)] }});
    </script>
@endsection