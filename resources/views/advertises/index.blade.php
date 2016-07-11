@extends('layouts.app')

@section('main-content')
    <div class="row" style="height: 600px;">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><a href="{{ url('advertises/create') }}" class="btn btn-primary">添加地址</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>名字</th>
                            <th>图片地址</th>
                            <th>操作</th>
                        </tr>
                        @foreach($advertises as $advertise)
                            <tr>
                                <td>{{ $advertise->id }}</td>
                                <td>{{ $advertise->name }}</td>
                                <td>{{ $advertise->img_url }}</td>
                                <td><a style="float: left;margin-right: 5px;" href="{{ url('advertises/'.$advertise->id.'/edit') }}" class="btn btn-info btn-xs">编辑</a>
                                    <form style="float: left;margin-top: -1px;" method="post" action="advertises/{{ $advertise->id }}">
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
