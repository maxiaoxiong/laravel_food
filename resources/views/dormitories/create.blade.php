@extends('layouts.app')

@section('main-content')
    <div class="box">
        <form action="{{ url('dormitories') }}" method="post">
            {!! csrf_field() !!}
            @include('dormitories.form')
        </form>
    </div>

    <script>
        function getFloors(building_id){
            $.getJSON('/getFloors/'+building_id,function(data){
                var str = "";
                for (var i=0;i<data.length;i++){
                    str+="<option value="+data[i].id+">"+data[i].name+"</option>"
                }
                $('#floor_id').html(str);
            })
        }
        {{ $arr = \App\Window::lists('id')->toArray() }}
        getFloors({{ $arr[0] }});
    </script>
@endsection