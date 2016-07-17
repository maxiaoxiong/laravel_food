@extends('layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><a href="{{ url('dormitories/create') }}" class="btn btn-primary">添加宿舍</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>楼号</th>
                            <th>楼层</th>
                            <th>宿舍号</th>
                            <th>操作</th>
                        </tr>
                        @foreach($buildings as $building)
                        <tr>
                            <td>{{ $building->name }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                            @foreach($building->floors as $floor)
                                <tr>
                                    <td></td>
                                    <td>{{ $floor->name }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @foreach($floor->dormitories as $dormitory)
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $dormitory->name }}</td>
                                        <td><a style="float: left;margin-right: 5px;" href="{{ url('dormitories/'.$dormitory->id.'/edit') }}" class="btn btn-info btn-xs">编辑</a>
                                            <form style="float: left;margin-top: -1px;" method="post" action="dormitories/{{ $dormitory->id }}">
                                                <input name="_method" type="hidden" value="delete">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-danger btn-xs">删除</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection