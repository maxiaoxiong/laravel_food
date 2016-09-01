@extends('layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><a href="{{ url('times/create') }}" class="btn btn-primary">添加类型名</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>类型</th>
                            <th>截止订餐时间</th>
                            <th>开始订餐时间</th>
                            <th>操作</th>
                        </tr>
                        @foreach($times as $time)
                            <tr>
                                <td>{{ $time->id }}</td>
                                <td>{{ $time->name }}</td>
                                <td>{{ $time->over_time }}</td>
                                <td>{{ $time->time }}</td>
                                <td><a style="float: left;margin-right: 5px;"
                                       href="{{ url('times/'.$time->id.'/edit') }}" class="btn btn-info btn-xs">编辑</a>
                                    <form style="float: left;margin-top: -1px;" method="post"
                                          action="times/{{ $time->id }}">
                                        <input name="_method" type="hidden" value="delete">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-danger btn-xs">删除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection