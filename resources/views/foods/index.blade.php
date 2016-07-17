@extends('layouts.app')

@section('htmlheader_title')
    Foods
@endsection

@section('main-content')
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ url('canteens/create') }}" class="btn bg-maroon btn-block">添加餐厅</a>
            </div>
            <div class="col-md-4">
                <a href="{{ url('windows/create') }}" class="btn bg-navy btn-block">添加窗口</a>
            </div>
            <div class="col-md-4">
                <a href="{{ url('dishes/create') }}" class="btn bg-olive btn-block">添加菜色</a>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">级联餐厅－窗口－菜色表格</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>餐厅</th>
                                <th>窗口</th>
                                <th>菜色</th>
                            </tr>
                            @foreach($canteens as $canteen)
                                <tr>
                                    <td>{{ $canteen->name }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @foreach($canteen->windows as $window)
                                    <tr>
                                        <td></td>
                                        <td>{{ $window->name }}</td>
                                        <td></td>
                                    </tr>
                                    @foreach($window->dishes as $dish)
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $dish->name }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            </div>
    </section>
@endsection