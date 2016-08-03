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
        margin: 0;
    }

    td {
        font-size: 12px;
        border: 1px solid black;
        padding: 40px;
        width: 100px;
        height: 70px;
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
                * {{ $dishes[$j]['dish_price'] }}元
                <br>
                {{ $dishes[$j]['user_name'] }}-{{ $dishes[$j]['user_phone'] }}
                <br>
                @if($dishes[$j]['taste'] != '')
                    ({{ $dishes[$j]['taste'] }})
                @endif
                @if($dishes[$j]['tableware'] != '')
                    ({{ $dishes[$j]['tableware'] }})
                @endif
                @if($dishes[$j]['typeone'] != '')
                    ({{ $dishes[$j]['typeone'] }})
                @endif
                @if($dishes[$j]['typetwo'] != '')
                    ({{ $dishes[$j]['typetwo'] }})
                @endif
                @if($dishes[$j]['typethree'] != '')
                    ({{ $dishes[$j]['typethree'] }})
                @endif
                @if($dishes[$j]['typefour'] != '')
                    ({{ $dishes[$j]['typefour'] }})
                @endif
                <br>
                {{ $dishes[$j]['address'] }}
            </td>
            <td align="center" valign="middle">
                {{ $dishes[$j+1]['canteen_name'] }}-{{ $dishes[$j+1]['window_name'] }}-{{ $dishes[$j+1]['dish_name'] }}
                * {{ $dishes[$j+1]['dish_price'] }}元
                <br>
                {{ $dishes[$j+1]['user_name'] }}-{{ $dishes[$j+1]['user_phone'] }}
                <br>
                @if($dishes[$j+1]['taste'] != '')
                    ({{ $dishes[$j+1]['taste'] }})
                @endif
                @if($dishes[$j+1]['tableware'] != '')
                    ({{ $dishes[$j+1]['tableware'] }})
                @endif
                @if($dishes[$j+1]['typeone'] != '')
                    ({{ $dishes[$j+1]['typeone'] }})
                @endif
                @if($dishes[$j+1]['typetwo'] != '')
                    ({{ $dishes[$j+1]['typetwo'] }})
                @endif
                @if($dishes[$j+1]['typethree'] != '')
                    ({{ $dishes[$j+1]['typethree'] }})
                @endif
                @if($dishes[$j+1]['typefour'] != '')
                    ({{ $dishes[$j+1]['typefour'] }})
                @endif
                <br>
                {{ $dishes[$j+1]['address'] }}
            </td>
            <td align="center" valign="middle">
                {{ $dishes[$j+2]['canteen_name'] }}-{{ $dishes[$j+2]['window_name'] }}-{{ $dishes[$j+2]['dish_name'] }}
                * {{ $dishes[$j+2]['dish_price'] }}元
                <br>
                {{ $dishes[$j+2]['user_name'] }}-{{ $dishes[$j+2]['user_phone'] }}
                <br>
                @if($dishes[$j+2]['taste'] != '')
                    ({{ $dishes[$j+2]['taste'] }})
                @endif
                @if($dishes[$j+2]['tableware'] != '')
                    ({{ $dishes[$j+2]['tableware'] }})
                @endif
                @if($dishes[$j+2]['typeone'] != '')
                    ({{ $dishes[$j+2]['typeone'] }})
                @endif
                @if($dishes[$j+2]['typetwo'] != '')
                    ({{ $dishes[$j+2]['typetwo'] }})
                @endif
                @if($dishes[$j+2]['typethree'] != '')
                    ({{ $dishes[$j+2]['typethree'] }})
                @endif
                @if($dishes[$j+2]['typefour'] != '')
                    ({{ $dishes[$j+2]['typefour'] }})
                @endif
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
                    * {{ $dishes[$k]['dish_price'] }}元
                    <br>
                    {{ $dishes[$k]['user_name'] }}-{{ $dishes[$k]['user_phone'] }}
                    <br>
                    @if($dishes[$k]['taste'] != '')
                        ({{ $dishes[$k]['taste'] }})
                    @endif
                    @if($dishes[$k]['tableware'] != '')
                        ({{ $dishes[$k]['tableware'] }})
                    @endif
                    @if($dishes[$k]['typeone'] != '')
                        ({{ $dishes[$k]['typeone'] }})
                    @endif
                    @if($dishes[$k]['typetwo'] != '')
                        ({{ $dishes[$k]['typetwo'] }})
                    @endif
                    @if($dishes[$k]['typethree'] != '')
                        ({{ $dishes[$k]['typethree'] }})
                    @endif
                    @if($dishes[$k]['typefour'] != '')
                        ({{ $dishes[$k]['typefour'] }})
                    @endif
                    <br>
                    {{ $dishes[$k]['address'] }}
                </td>
            @endfor
        </tr>
    @endif
</table>
</body>
</html>
