@extends('layouts.app')

@section('main-content')
    @include('layouts.flashs.message')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">推送历史</h3>
        </div>
        <div class="box-body">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">及时推送历史</div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tr>
                            <th>id</th>
                            <th>msg_id</th>
                            <th>sendno</th>
                            <th>内容</th>
                            <th>发送时间</th>
                            <th>发送状态</th>
                        </tr>
                        @foreach($timelys as $timely)
                            <tr>
                                <td>{{ $timely->id }}</td>
                                <td>{{ $timely->msg_id }}</td>
                                <td>{{ $timely->sendno }}</td>
                                <td>{{ $timely->content }}</td>
                                <td>{{ $timely->created_at }}</td>
                                <td><span class="label label-success">Success</span></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="panel-title">定时推送列表</div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tr>
                            <th>id</th>
                            <th>schedule_id</th>
                            <th>name</th>
                            <th>内容</th>
                            <th>定时时间</th>
                            <th>发送状态</th>
                        </tr>
                        @foreach($timings as $timing)
                            <tr>
                                <td>{{ $timing->id }}</td>
                                <td>{{ $timing->schedule_id }}</td>
                                <td>{{ $timing->name }}</td>
                                <td>{{ $timing->content }}</td>
                                <td>{{ $timing->time }}</td>
                                <td><span class="label label-success">Success</span></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection