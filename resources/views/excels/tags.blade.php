<!doctype html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>标签</title>
</head>
<style>
    @font-face {
        font-family: 'Noto Sans';
        font-style: normal;
        font-weight: 400;
        src: url(http://eclecticgeek.com/dompdf/fonts/cjk/fireflysung.ttf) format('truetype');
    }

    * {
        font-family: Noto Sans, DejaVu Sans, sans-serif;
    }

    td {
        border: 1px solid black;
        padding-left: 40px;
        padding-right: 40px;
    }

</style>
<body>
<table>
    {{--@for($j=0;$j<count($dishes);$j++)--}}
    {{ $j = 0 }}
    {{ $count_dishes = count($dishes) }}
    @for($i=0;$i<floor($count_dishes/3);$i++)
        <tr>
            <td align="center" valign="middle">
                {{ $dishes[$j]['canteen_name'] }}-{{ $dishes[$j]['window_name'] }}-{{ $dishes[$j]['dish_name'] }}
                * {{ $dishes[$j]['dish_price'] }}
                <br>
                {{ $dishes[$j]['user_name'] }}
                <br>
                {{ $dishes[$j]['user_phone'] }}
                <br>
                {{ $dishes[$j]['taste'] }}
                <br>
                {{ $dishes[$j]['tableware'] }}
                <br>
                {{ $dishes[$j]['typeone'] }}
                <br>
                {{ $dishes[$j]['typetwo'] }}
                <br>
                {{ $dishes[$j]['typethree'] }}
                <br>
                {{ $dishes[$j]['typefour'] }}
                <br>
                {{ $dishes[$j]['address'] }}
            </td>
            <td align="center" valign="middle">
                {{ $dishes[$j+1]['canteen_name'] }}-{{ $dishes[$j+1]['window_name'] }}-{{ $dishes[$j+1]['dish_name'] }}
                * {{ $dishes[$j+1]['dish_price'] }}
                <br>
                {{ $dishes[$j+1]['user_name'] }}
                <br>
                {{ $dishes[$j+1]['user_phone'] }}
                <br>
                {{ $dishes[$j+1]['taste'] }}
                <br>
                {{ $dishes[$j+1]['tableware'] }}
                <br>
                {{ $dishes[$j+1]['typeone'] }}
                <br>
                {{ $dishes[$j+1]['typetwo'] }}
                <br>
                {{ $dishes[$j+1]['typethree'] }}
                <br>
                {{ $dishes[$j+1]['typefour'] }}
                <br>
                {{ $dishes[$j+1]['address'] }}
            </td>
            <td align="center" valign="middle">
                {{ $dishes[$j+2]['canteen_name'] }}-{{ $dishes[$j+2]['window_name'] }}-{{ $dishes[$j+2]['dish_name'] }}
                * {{ $dishes[$j+2]['dish_price'] }}
                <br>
                {{ $dishes[$j+2]['user_name'] }}
                <br>
                {{ $dishes[$j+2]['user_phone'] }}
                <br>
                {{ $dishes[$j+2]['taste'] }}
                <br>
                {{ $dishes[$j+2]['tableware'] }}
                <br>
                {{ $dishes[$j+2]['typeone'] }}
                <br>
                {{ $dishes[$j+2]['typetwo'] }}
                <br>
                {{ $dishes[$j+2]['typethree'] }}
                <br>
                {{ $dishes[$j+2]['typefour'] }}
                <br>
                {{ $dishes[$j+2]['address'] }}
            </td>
        </tr>
        {{ $j = $j+3 }}
    @endfor
    @if($count_dishes != 0)
        <tr>
            @for($k=3*floor($count_dishes/3);$k<$count_dishes;$k++)
                <td align="center" valign="middle">
                    {{ $dishes[$k]['canteen_name'] }}-{{ $dishes[$k]['window_name'] }}-{{ $dishes[$k]['dish_name'] }}
                    * {{ $dishes[$k]['dish_price'] }}
                    <br>
                    {{ $dishes[$k]['user_name'] }}
                    <br>
                    {{ $dishes[$k]['user_phone'] }}
                    <br>
                    {{ $dishes[$k]['taste'] }}
                    <br>
                    {{ $dishes[$k]['tableware'] }}
                    <br>
                    {{ $dishes[$k]['typeone'] }}
                    <br>
                    {{ $dishes[$k]['typetwo'] }}
                    <br>
                    {{ $dishes[$k]['typethree'] }}
                    <br>
                    {{ $dishes[$k]['typefour'] }}
                    <br>
                    {{ $dishes[$k]['address'] }}
                </td>
            @endfor
        </tr>
    @endif
</table>
</body>
</html>
