@extends('layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><a href="{{ url('windows/create') }}" class="btn btn-primary">添加窗口</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>窗口号</th>
                            <th>所属餐厅</th>
                            <th>菜数</th>
                            <th>Handle</th>
                        </tr>
                        @foreach($windows as $window)
                        <tr>
                            <td>{{ $window->id }}</td>
                            <td>{{ $window->window_name }}</td>
                            <td>{{ $window->canteen->canteen_name }}</td>
                            <td>{{ count($window->dishes) }}</td>
                            <td><a style="float: left;margin-right: 5px;" href="{{ url('windows/'.$window->id.'/edit') }}" class="btn btn-info btn-xs">编辑</a>
                                <form style="float: left;margin-top: -1px;" method="post" action="windows/{{ $window->id }}">
                                    <input name="_method" type="hidden" value="delete">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-danger btn-xs">删除</button>
                                </form>
                        </tr>
                            @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection