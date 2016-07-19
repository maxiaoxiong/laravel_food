<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>窗口明细表</title>
</head>
<body>
<table>
    <tr>
        <td>本月已下订单</td>
        <td>本月成功订单</td>
        <td>销售总数</td>
        <td>金额总计</td>
    </tr>
    <tr>
        <td>{{ \App\Order::where('created_at',\Carbon\Carbon::createFromDate()->startOfMonth())->count() }}</td>
        <td>{{ count($datas) }}</td>
        <td>
            {{ $num = 0 }}
            @foreach($datas as $order)
                @foreach($order->dishes as $dish)
                    {{ $num += $dish->pivot->num }}
                @endforeach
            @endforeach
        </td>
        {{ $price = 0 }}
        @foreach($datas as $order)
            {{ $price += $order->price }}
        @endforeach
        <td>
            {{ $price }}
        </td>
    </tr>
</table>
</body>
</html>