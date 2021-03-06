@extends('layouts.app')

@section('htmlheader_title')
    Typefours
@endsection

@section('main-content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        <a href="{{ url('typefours/create') }}" class="btn btn-primary">添加类型四</a>
                    </h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>#</th>
                            <th>名称</th>
                            <th>价格</th>
                            <th>操作</th>
                        </tr>
                        @foreach($typefours as $typefour)
                            <tr>
                                <td>{{ $typefour->id }}</td>
                                <td>{{ $typefour->name }}</td>
                                <td>{{ $typefour->price }}</td>
                                <td><a style="float: left;margin-right: 5px;" href="{{ url('typefours/'.$typefour->id.'/edit') }}" class="btn btn-info btn-xs">编辑</a>
                                    <form style="float: left;margin-top: -1px;" method="post" action="typefours/{{ $typefour->id }}">
                                        <input name="_method" type="hidden" value="delete">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-danger btn-xs">删除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection