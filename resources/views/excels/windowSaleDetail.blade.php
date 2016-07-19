<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>窗口明细表</title>
</head>
<body>
<table>
    <tr>
        <td>餐厅名</td>
        <td>窗口名</td>
        <td>菜名</td>
        <td>份数</td>
        <td>需支付金钱</td>
    </tr>
    @foreach($windows as $window)
        {{ $dishes = $window->dishes }}
        @foreach($dishes as $dish)
            {{ $orders = $dish->orders()->where('status','已付款')->where('orders.created_at','>=',\Carbon\Carbon::createFromDate()
            ->startOfMonth())->get() }}
            @if(count($orders) != 0)
                <tr>
                    <td>{{ $window->canteen->name }}</td>
                    <td>{{ $window->name }}</td>
                    <td>{{ $dish->name }}</td>
                    @foreach($orders as $order)
                        {{ $sum += $order->pivot->num }}
                    @endforeach
                    <td>
                        {{ $sum }}
                    </td>
                    <td>
                        {{ $sum * $dish->price }}
                    </td>
                </tr>
            @endif
        @endforeach
    @endforeach
</table>
</body>
</html>