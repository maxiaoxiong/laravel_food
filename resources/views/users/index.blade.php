@extends('layouts.app')

@section('main-content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">用户信息</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <th>用户名</th>
                    <th>订餐量</th>
                    <th>手机号</th>
                    <th>注册时间</th>
                </tr>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ count($user->orders) }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
                    @endforeach
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center clearfix">
            {!! $users->links() !!}
        </div>
    </div>
@endsection