@extends('layouts.app')

@section('main-content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <a href="{{ url('orders/printOrders/4') }}" class="btn btn-info">销售总额明细</a>
                <a href="{{ url('orders/printOrders/5') }}" class="btn btn-primary">本月餐厅窗口明细</a>
                <a href="{{ url('orders/printOrders/6') }}" class="btn btn-success">打印宿舍各层明细</a>
            </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <th>订单号</th>
                    <th>订单人</th>
                    <th>联系电话</th>
                    <th>支付金额</th>
                    <th>支付状态</th>
                    <th>下单时间</th>
                </tr>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->order_no }}</td>
                        <td>{{ $order->user_name }}</td>
                        <td>{{ $order->user_phone }}</td>
                        <td><span class="label label-default">{{ $order->price }}</span></td>
                        <td>
                            <span class="label @if($order->status == "未付款")label-danger @else label-success @endif">{{ $order->status }}</span>
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