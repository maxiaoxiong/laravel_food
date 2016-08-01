<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>标签</title>
</head>
<style>
    td {
        height: 110px;
        width: 35px;
    }
</style>
<body>
<table>
    @foreach($dishes as $dish)
        {{ $orders = \App\Components\ExcelExport::getOrders($dish) }}
        @if(count($orders) != 0)
            @foreach($orders as $order)
                @for($i=0;$i<floor(($order->pivot->num)/3);$i++)
                    <tr>
                        <td align="center" valign="middle">
                            {{ $dish->name }}
                            1* {{ $dish->price }}
                            <br>
                            {{ $order->user_name }} * {{ $order->user_phone }}<br>
                            @if(count($order->typeones) != 0)
                                @foreach($order->typeones as $typeone)
                                    {{ $typeone->name }}
                                @endforeach
                                <br>
                            @endif
                            @if(count($order->typetwos) != 0)
                                @foreach($order->typetwos as $typetwo)
                                    {{ $typetwo->name }}
                                @endforeach
                                <br>
                            @endif
                            @if(count($order->typethrees) != 0)
                                @foreach($order->typethrees as $typethree)
                                    {{ $typethree->name }}
                                @endforeach
                                <br>
                            @endif
                            @if(count($order->typefours) != 0)
                                @foreach($order->typefours as $typefour)
                                    {{ $typefour->name }}
                                @endforeach
                                <br>
                            @endif
                            @if(count($order->tastes) != 0)
                                @foreach($order->tastes as $taste)
                                    {{ $taste->name }}
                                @endforeach
                                <br>
                            @endif
                            @if(count($order->tablewares) != 0)
                                @foreach($order->tablewares as $tableware)
                                    {{ $tableware->name }}
                                @endforeach
                                <br>
                            @endif
                            {{ $order->dormitory->floor->building->name }}.{{ $order->dormitory->floor->name }}
                            .{{ $order->dormitory->name }}
                        </td>
                        <td align="center" valign="middle">
                            {{ $dish->name }}
                            1* {{ $dish->price }}
                            <br>
                            {{ $order->user_name }}<br>
                            {{ $order->user_phone }}<br>
                            @if(count($order->typeones) != 0)
                                @foreach($order->typeones as $typeone)
                                    {{ $typeone->name }}
                                @endforeach
                                <br>
                            @endif
                            @if(count($order->typetwos) != 0)
                                @foreach($order->typetwos as $typetwo)
                                    {{ $typetwo->name }}
                                @endforeach
                                <br>
                            @endif
                            @if(count($order->typethrees) != 0)
                                @foreach($order->typethrees as $typethree)
                                    {{ $typethree->name }}
                                @endforeach
                                <br>
                            @endif
                            @if(count($order->typefours) != 0)
                                @foreach($order->typefours as $typefour)
                                    {{ $typefour->name }}
                                @endforeach
                                <br>
                            @endif
                            @if(count($order->tastes) != 0)
                                @foreach($order->tastes as $taste)
                                    {{ $taste->name }}
                                @endforeach
                                <br>
                            @endif
                            @if(count($order->tablewares) != 0)
                                @foreach($order->tablewares as $tableware)
                                    {{ $tableware->name }}
                                @endforeach
                                <br>
                            @endif
                            {{ $order->dormitory->floor->building->name }}.{{ $order->dormitory->floor->name }}
                            .{{ $order->dormitory->name }}
                        </td>
                        <td align="center" valign="middle">
                            {{ $dish->name }}
                            1* {{ $dish->price }}
                            <br>
                            {{ $order->user_name }}<br>
                            {{ $order->user_phone }}<br>
                            @if(count($order->typeones) != 0)
                                @foreach($order->typeones as $typeone)
                                    {{ $typeone->name }}
                                @endforeach
                                <br>
                            @endif
                            @if(count($order->typetwos) != 0)
                                @foreach($order->typetwos as $typetwo)
                                    {{ $typetwo->name }}
                                @endforeach
                                <br>
                            @endif
                            @if(count($order->typethrees) != 0)
                                @foreach($order->typethrees as $typethree)
                                    {{ $typethree->name }}
                                @endforeach
                                <br>
                            @endif
                            @if(count($order->typefours) != 0)
                                @foreach($order->typefours as $typefour)
                                    {{ $typefour->name }}
                                @endforeach
                                <br>
                            @endif
                            @if(count($order->tastes) != 0)
                                @foreach($order->tastes as $taste)
                                    {{ $taste->name }}
                                @endforeach
                                <br>
                            @endif
                            @if(count($order->tablewares) != 0)
                                @foreach($order->tablewares as $tableware)
                                    {{ $tableware->name }}
                                @endforeach
                                <br>
                            @endif
                            {{ $order->dormitory->floor->building->name }}.{{ $order->dormitory->floor->name }}
                            .{{ $order->dormitory->name }}
                        </td>
                    </tr>
                @endfor
                @if((($order->pivot->num)%3) != 0)
                    <tr>
                        @for($i=0;$i<(($order->pivot->num)%3);$i++)
                            <td align="center" valign="middle">
                                {{ $dish->name }}
                                1* {{ $dish->price }}
                                <br>
                                {{ $order->user_name }}<br>
                                {{ $order->user_phone }}<br>
                                @if(count($order->typeones) != 0)
                                    @foreach($order->typeones as $typeone)
                                        {{ $typeone->name }}
                                    @endforeach
                                    <br>
                                @endif
                                @if(count($order->typetwos) != 0)
                                    @foreach($order->typetwos as $typetwo)
                                        {{ $typetwo->name }}
                                    @endforeach
                                    <br>
                                @endif
                                @if(count($order->typethrees) != 0)
                                    @foreach($order->typethrees as $typethree)
                                        {{ $typethree->name }}
                                    @endforeach
                                    <br>
                                @endif
                                @if(count($order->typefours) != 0)
                                    @foreach($order->typefours as $typefour)
                                        {{ $typefour->name }}
                                    @endforeach
                                    <br>
                                @endif
                                @if(count($order->tastes) != 0)
                                    @foreach($order->tastes as $taste)
                                        {{ $taste->name }}
                                    @endforeach
                                    <br>
                                @endif
                                @if(count($order->tablewares) != 0)
                                    @foreach($order->tablewares as $tableware)
                                        {{ $tableware->name }}
                                    @endforeach
                                    <br>
                                @endif
                                <br>
                                {{ $order->dormitory->floor->building->name }}.{{ $order->dormitory->floor->name }}
                                .{{ $order->dormitory->name }}
                            </td>
                        @endfor
                    </tr>
                @endif
            @endforeach
        @endif
    @endforeach
</table>
</body>
</html>
