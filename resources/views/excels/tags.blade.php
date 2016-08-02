<!doctype html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>标签</title>
</head>
<style>
    td {
        height: 110px;
        width: 35px;
    }

    @font-face {
        font-family: 'Noto Sans';
        font-style: normal;
        font-weight: 400;
        src: url(http://eclecticgeek.com/dompdf/fonts/cjk/fireflysung.ttf) format('truetype');
    }

    * {
        font-family: Noto Sans, DejaVu Sans, sans-serif;
    }
</style>
<body>
<table>
    {{--@for($j=0;$j<count($dishes);$j++)--}}
    {{ $j = 0 }}
    @for($i=0;$i<floor(count($dishes)/3);$i++)
        <tr>
            <td align="center" valign="middle">
                {{ $dishes[$j]['dish_price'] }} * {{ $dishes[$j]['dish_price'] }}
                <br>
                {{ $dishes[$j]['user_name'] }}
                <br>
                {{ $dishes[$j]['user_phone'] }}
                <br>
                @foreach($dishes[$j]['typeone'] as $typeone)
                    {{ $typeone->name }}
                @endforeach
                <br>
                @foreach($dishes[$j]['typetwo'] as $typetwo)
                    {{ $typetwo->name }}
                @endforeach
                <br>
                @foreach($dishes[$j]['typethree'] as $typethree)
                    {{ $typethree->name }}
                @endforeach
                <br>
                @foreach($dishes[$j]['typefour'] as $typefour)
                    {{ $typefour->name }}
                @endforeach
                <br>
                @foreach($dishes[$j]['taste'] as $taste)
                    {{ $taste->name }}
                @endforeach
                <br>
                @foreach($dishes[$j]['tableware'] as $tableware)
                    {{ $tableware->name }}
                @endforeach
                <br>
                {{ $dishes[$j]['address'] }}
            </td>
            <td align="center" valign="middle">
                {{ $dishes[$j+1]['dish_price'] }} * {{ $dishes[$j+1]['dish_price'] }}
                <br>
                {{ $dishes[$j+1]['user_name'] }}
                <br>
                {{ $dishes[$j+1]['user_phone'] }}
                <br>
                @foreach($dishes[$j+1]['typeone'] as $typeone)
                    {{ $typeone->name }}
                @endforeach
                <br>
                @foreach($dishes[$j+1]['typetwo'] as $typetwo)
                    {{ $typetwo->name }}
                @endforeach
                <br>
                @foreach($dishes[$j+1]['typethree'] as $typethree)
                    {{ $typethree->name }}
                @endforeach
                <br>
                @foreach($dishes[$j+1]['typefour'] as $typefour)
                    {{ $typefour->name }}
                @endforeach
                <br>
                @foreach($dishes[$j+1]['taste'] as $taste)
                    {{ $taste->name }}
                @endforeach
                <br>
                @foreach($dishes[$j+1]['tableware'] as $tableware)
                    {{ $tableware->name }}
                @endforeach
                <br>
                {{ $dishes[$j+1]['address'] }}
            </td>
            <td align="center" valign="middle">
                {{ $dishes[$j+2]['dish_price'] }} * {{ $dishes[$j+2]['dish_price'] }}
                <br>
                {{ $dishes[$j+2]['user_name'] }}
                <br>
                {{ $dishes[$j+2]['user_phone'] }}
                <br>
                @foreach($dishes[$j+2]['typeone'] as $typeone)
                    {{ $typeone->name }}
                @endforeach
                <br>
                @foreach($dishes[$j+2]['typetwo'] as $typetwo)
                    {{ $typetwo->name }}
                @endforeach
                <br>
                @foreach($dishes[$j+2]['typethree'] as $typethree)
                    {{ $typethree->name }}
                @endforeach
                <br>
                @foreach($dishes[$j+2]['typefour'] as $typefour)
                    {{ $typefour->name }}
                @endforeach
                <br>
                @foreach($dishes[$j+2]['taste'] as $taste)
                    {{ $taste->name }}
                @endforeach
                <br>
                @foreach($dishes[$j+2]['tableware'] as $tableware)
                    {{ $tableware->name }}
                @endforeach
                <br>
                {{ $dishes[$j+2]['address'] }}
            </td>
        </tr>
        {{ $j = $j+3 }}
    @endfor
    <tr>
        @for($k=0;$k<(count($dishes))%3;$k++)
            <td align="center" valign="middle">
                {{ $dishes[$k]['dish_price'] }} * {{ $dishes[$k]['dish_price'] }}
                <br>
                {{ $dishes[$k]['user_name'] }}
                <br>
                {{ $dishes[$k]['user_phone'] }}
                <br>
                @foreach($dishes[$k]['typeone'] as $typeone)
                    {{ $typeone->name }}
                @endforeach
                <br>
                @foreach($dishes[$k]['typetwo'] as $typetwo)
                    {{ $typetwo->name }}
                @endforeach
                <br>
                @foreach($dishes[$k]['typethree'] as $typethree)
                    {{ $typethree->name }}
                @endforeach
                <br>
                @foreach($dishes[$k]['typefour'] as $typefour)
                    {{ $typefour->name }}
                @endforeach
                <br>
                @foreach($dishes[$k]['taste'] as $taste)
                    {{ $taste->name }}
                @endforeach
                <br>
                @foreach($dishes[$k]['tableware'] as $tableware)
                    {{ $tableware->name }}
                @endforeach
                <br>
                {{ $dishes[$k]['address'] }}
            </td>
        @endfor
    </tr>

    {{--@endfor--}}

    {{--{{ $orders = \App\Components\ExcelExport::getOrders($dish) }}--}}
    {{--@if(count($orders) != 0)--}}
    {{--@foreach($orders as $order)--}}
    {{--@for($i=0;$i<floor(($order->pivot->num)/3);$i++)--}}
    {{--<tr>--}}
    {{--<td align="center" valign="middle">--}}
    {{--{{ $dish->name }}--}}
    {{--1* {{ $dish->price }}--}}
    {{--<br>--}}
    {{--{{ $order->user_name }} * {{ $order->user_phone }}<br>--}}
    {{--@if(count($order->typeones) != 0)--}}
    {{--@foreach($order->typeones as $typeone)--}}
    {{--{{ $typeone->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->typetwos) != 0)--}}
    {{--@foreach($order->typetwos as $typetwo)--}}
    {{--{{ $typetwo->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->typethrees) != 0)--}}
    {{--@foreach($order->typethrees as $typethree)--}}
    {{--{{ $typethree->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->typefours) != 0)--}}
    {{--@foreach($order->typefours as $typefour)--}}
    {{--{{ $typefour->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->tastes) != 0)--}}
    {{--@foreach($order->tastes as $taste)--}}
    {{--{{ $taste->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->tablewares) != 0)--}}
    {{--@foreach($order->tablewares as $tableware)--}}
    {{--{{ $tableware->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--{{ $order->dormitory->floor->building->name }}.{{ $order->dormitory->floor->name }}--}}
    {{--.{{ $order->dormitory->name }}--}}
    {{--</td>--}}
    {{--<td align="center" valign="middle">--}}
    {{--{{ $dish->name }}--}}
    {{--1* {{ $dish->price }}--}}
    {{--<br>--}}
    {{--{{ $order->user_name }}<br>--}}
    {{--{{ $order->user_phone }}<br>--}}
    {{--@if(count($order->typeones) != 0)--}}
    {{--@foreach($order->typeones as $typeone)--}}
    {{--{{ $typeone->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->typetwos) != 0)--}}
    {{--@foreach($order->typetwos as $typetwo)--}}
    {{--{{ $typetwo->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->typethrees) != 0)--}}
    {{--@foreach($order->typethrees as $typethree)--}}
    {{--{{ $typethree->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->typefours) != 0)--}}
    {{--@foreach($order->typefours as $typefour)--}}
    {{--{{ $typefour->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->tastes) != 0)--}}
    {{--@foreach($order->tastes as $taste)--}}
    {{--{{ $taste->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->tablewares) != 0)--}}
    {{--@foreach($order->tablewares as $tableware)--}}
    {{--{{ $tableware->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--{{ $order->dormitory->floor->building->name }}.{{ $order->dormitory->floor->name }}--}}
    {{--.{{ $order->dormitory->name }}--}}
    {{--</td>--}}
    {{--<td align="center" valign="middle">--}}
    {{--{{ $dish->name }}--}}
    {{--1* {{ $dish->price }}--}}
    {{--<br>--}}
    {{--{{ $order->user_name }}<br>--}}
    {{--{{ $order->user_phone }}<br>--}}
    {{--@if(count($order->typeones) != 0)--}}
    {{--@foreach($order->typeones as $typeone)--}}
    {{--{{ $typeone->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->typetwos) != 0)--}}
    {{--@foreach($order->typetwos as $typetwo)--}}
    {{--{{ $typetwo->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->typethrees) != 0)--}}
    {{--@foreach($order->typethrees as $typethree)--}}
    {{--{{ $typethree->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->typefours) != 0)--}}
    {{--@foreach($order->typefours as $typefour)--}}
    {{--{{ $typefour->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->tastes) != 0)--}}
    {{--@foreach($order->tastes as $taste)--}}
    {{--{{ $taste->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->tablewares) != 0)--}}
    {{--@foreach($order->tablewares as $tableware)--}}
    {{--{{ $tableware->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--{{ $order->dormitory->floor->building->name }}.{{ $order->dormitory->floor->name }}--}}
    {{--.{{ $order->dormitory->name }}--}}
    {{--</td>--}}
    {{--</tr>--}}
    {{--@endfor--}}
    {{--@if((($order->pivot->num)%3) != 0)--}}
    {{--<tr>--}}
    {{--@for($i=0;$i<(($order->pivot->num)%3);$i++)--}}
    {{--<td align="center" valign="middle">--}}
    {{--{{ $dish->name }}--}}
    {{--1* {{ $dish->price }}--}}
    {{--<br>--}}
    {{--{{ $order->user_name }}<br>--}}
    {{--{{ $order->user_phone }}<br>--}}
    {{--@if(count($order->typeones) != 0)--}}
    {{--@foreach($order->typeones as $typeone)--}}
    {{--{{ $typeone->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->typetwos) != 0)--}}
    {{--@foreach($order->typetwos as $typetwo)--}}
    {{--{{ $typetwo->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->typethrees) != 0)--}}
    {{--@foreach($order->typethrees as $typethree)--}}
    {{--{{ $typethree->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->typefours) != 0)--}}
    {{--@foreach($order->typefours as $typefour)--}}
    {{--{{ $typefour->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->tastes) != 0)--}}
    {{--@foreach($order->tastes as $taste)--}}
    {{--{{ $taste->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--@if(count($order->tablewares) != 0)--}}
    {{--@foreach($order->tablewares as $tableware)--}}
    {{--{{ $tableware->name }}--}}
    {{--@endforeach--}}
    {{--<br>--}}
    {{--@endif--}}
    {{--<br>--}}
    {{--{{ $order->dormitory->floor->building->name }}.{{ $order->dormitory->floor->name }}--}}
    {{--.{{ $order->dormitory->name }}--}}
    {{--</td>--}}
    {{--@endfor--}}
    {{--</tr>--}}
    {{--@endif--}}
    {{--@endforeach--}}
    {{--@endif--}}
</table>
</body>
</html>
