@extends('layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><a href="{{ url('tastes/create') }}" class="btn btn-primary">添加口味</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>口味</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        @foreach($tastes as $taste)
                        <tr>
                            <td>{{ $taste->id }}</td>
                            <td>{{ $taste->name }}</td>
                            <td>{{ $taste->created_at }}</td>
                            <td><a style="float: left;margin-right: 5px;" href="{{ url('tastes/'.$taste->id.'/edit') }}" class="btn btn-info btn-xs">编辑</a>
                                <form style="float: left;margin-top: -1px;" method="post" action="tastes/{{ $taste->id }}">
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