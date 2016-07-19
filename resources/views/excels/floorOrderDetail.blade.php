<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>窗口明细表</title>
</head>
<body>
<table>
    <tr>
        <td>楼号名</td>
        <td>层数</td>
        <td>订购数量</td>
        <td>总金额金钱</td>
    </tr>
    @foreach($floors as $floor)
        {{ $dormitories = $floor->dormitories }}
        @foreach($dormitories as $dormitory)
            {{ $orders = $dormitory->orders()->where('status','已付款')->where('orders.created_at','>=',\Carbon\Carbon::createFromDate()
            ->startOfMonth())->get() }}
            @if(count($orders) != 0)
                @foreach($orders as $order)
                    {{ $order_price_count += $order->price }}
                    @foreach($order->dishes as $dish)
                        {{ $sum += $dish->pivot->num }}
                    @endforeach
                @endforeach
                <tr>
                    <td>{{ $floor->building->name }}</td>
                    <td>{{ $floor->name }}</td>

                    <td>
                        {{ $sum }}
                    </td>
                    <td>
                        {{ $order_price_count }}
                    </td>
                </tr>
            @endif
        @endforeach
    @endforeach
</table>
</body>
</html>