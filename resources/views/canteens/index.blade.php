@extends('layouts.app')

@section('main-content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><a href="{{ url('canteens/create') }}" class="btn btn-primary">添加餐厅</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>餐厅名</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        @foreach($canteens as $canteen)
                        <tr>
                            <td>{{ $canteen->id }}</td>
                            <td>{{ $canteen->canteen_name }}</td>
                            <td>{{ $canteen->created_at }}</td>
                            <td><a style="float: left;margin-right: 5px;" href="{{ url('canteens/'.$canteen->id.'/edit') }}" class="btn btn-info btn-xs">编辑</a>
                                <form style="float: left;margin-top: -1px;" method="post" action="canteens/{{ $canteen->id }}">
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