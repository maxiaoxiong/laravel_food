@extends('layouts.app')

@section('main-content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><a href="{{ url('orders/printOrders/2') }}" class="btn btn-info">打印本周订单</a></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <th>订单号</th>
                    <th>订单人</th>
                    <th>菜名</th>
                    <th>口味</th>
                    <th>餐具</th>
                    <th>下单时间</th>
                </tr>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->dish->dish_name }}</td>
                        <td class="text-light-blue">
                            @foreach($order->tastes as $taste)
                                {{ $taste->name }}&nbsp;
                            @endforeach
                        </td>
                        <td class="text-green">
                            @foreach($order->tablewares as $tableware)
                                {{ $tableware->tableware_name }}
                            @endforeach
                        </td>
                        <td>{{ $order->created_at }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix text-center">
            {!! $orders->links() !!}
        </div>
    </div>
@endsection