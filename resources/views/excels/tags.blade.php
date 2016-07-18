<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>标签</title>
</head>
<body>
<table>
    @foreach($dishes as $dish)
        {{ $orders = $dish->orders()->where('orders.created_at','>=','2016-07-18 09:12:34')->get() }}
        @foreach($orders as $order)
            @for($i=0;$i<floor(($order->pivot->num)/3);$i++)
                <tr>
                    <td align="center" valign="middle" height="70" width="40">
                        {{ $dish->name }}
                        1* {{ $dish->price }}
                        <br>
                        {{ $order->user_name }}<br>
                        {{ $order->user_phone }}<br>
                        @foreach($order->tastes as $taste)
                            {{ $taste->name }}
                        @endforeach
                        <br>
                        @foreach($order->tablewares as $tableware)
                            {{ $tableware->name }}
                        @endforeach
                        <br>
                        {{ $order->dormitory->floor->building->name }}.{{ $order->dormitory->floor->name }}
                        .{{ $order->dormitory->name }}
                    </td>
                    <td align="center" valign="middle" height="70" width="40">
                        {{ $dish->name }}
                        1* {{ $dish->price }}
                        <br>
                        {{ $order->user_name }}<br>
                        {{ $order->user_phone }}<br>
                        @foreach($order->tastes as $taste)
                            {{ $taste->name }}
                        @endforeach
                        <br>
                        @foreach($order->tablewares as $tableware)
                            {{ $tableware->name }}
                        @endforeach
                        <br>
                        {{ $order->dormitory->floor->building->name }}.{{ $order->dormitory->floor->name }}
                        .{{ $order->dormitory->name }}
                    </td>
                    <td align="center" valign="middle" height="70" width="40">
                        {{ $dish->name }}
                        1* {{ $dish->price }}
                        <br>
                        {{ $order->user_name }}<br>
                        {{ $order->user_phone }}<br>
                        @foreach($order->tastes as $taste)
                            {{ $taste->name }}
                        @endforeach
                        <br>
                        @foreach($order->tablewares as $tableware)
                            {{ $tableware->name }}
                        @endforeach
                        <br>
                        {{ $order->dormitory->floor->building->name }}.{{ $order->dormitory->floor->name }}
                        .{{ $order->dormitory->name }}
                    </td>
                </tr>
            @endfor
            <tr>
                @for($i=0;$i<(($order->pivot->num)%3);$i++)
                    <td align="center" valign="middle" height="70" width="40">
                        {{ $dish->name }}
                        1* {{ $dish->price }}
                        <br>
                        {{ $order->user_name }}<br>
                        {{ $order->user_phone }}<br>
                        @foreach($order->tastes as $taste)
                            {{ $taste->name }}
                        @endforeach
                        <br>
                        @foreach($order->tablewares as $tableware)
                            {{ $tableware->name }}
                        @endforeach
                        <br>
                        {{ $order->dormitory->floor->building->name }}.{{ $order->dormitory->floor->name }}
                        .{{ $order->dormitory->name }}
                    </td>
                @endfor
            </tr>
        @endforeach
    @endforeach
</table>
</body>
</html>
