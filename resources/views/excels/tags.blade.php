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
    @for($i=0;$i<floor(count($dishes)/3);$i++)
        <tr>
            <td align="center" valign="middle">
                {{ $dishes[$j]['canteen_name'] }}-{{ $dishes[$j]['window_name'] }}-{{ $dishes[$j]['dish_name'] }} * {{ $dishes[$j]['dish_price'] }}
                <br>
                {{ $dishes[$j]['user_name'] }}
                <br>
                {{ $dishes[$j]['user_phone'] }}
                <br>
                @if(count($dishes[$j]['typeone']) != 0)
                    @foreach($dishes[$j]['typeone'] as $typeone)
                        {{ $typeone->name }}
                    @endforeach
                    <br>
                @endif
                @if(count($dishes[$j]['typetwo']) != 0)
                    @foreach($dishes[$j]['typetwo'] as $typetwo)
                        {{ $typetwo->name }}
                    @endforeach
                    <br>
                @endif
                @if(count($dishes[$j]['typethree']) != 0)
                    @foreach($dishes[$j]['typethree'] as $typethree)
                        {{ $typethree->name }}
                    @endforeach
                    <br>
                @endif
                @if(count($dishes[$j]['typefour']) != 0)
                    @foreach($dishes[$j]['typefour'] as $typefour)
                        {{ $typefour->name }}
                    @endforeach
                    <br>
                @endif
                @if(count($dishes[$j]['taste']) != 0)
                    @foreach($dishes[$j]['taste'] as $taste)
                        {{ $taste->name }}
                    @endforeach
                    <br>
                @endif
                @foreach($dishes[$j]['tableware'] as $tableware)
                    {{ $tableware->name }}
                @endforeach
                <br>
                {{ $dishes[$j]['address'] }}
            </td>
            <td align="center" valign="middle">
                {{ $dishes[$j+1]['canteen_name'] }}-{{ $dishes[$j+1]['window_name'] }}-{{ $dishes[$j+1]['dish_name'] }} * {{ $dishes[$j+1]['dish_price'] }}
                <br>
                {{ $dishes[$j+1]['user_name'] }}
                <br>
                {{ $dishes[$j+1]['user_phone'] }}
                <br>
                @if(count($dishes[$j+1]['typeone']) != 0)
                    @foreach($dishes[$j+1]['typeone'] as $typeone)
                        {{ $typeone->name }}
                    @endforeach
                    <br>
                @endif
                @if(count($dishes[$j+1]['typetwo']) != 0)
                    @foreach($dishes[$j+1]['typetwo'] as $typetwo)
                        {{ $typetwo->name }}
                    @endforeach
                    <br>
                @endif
                @if(count($dishes[$j+1]['typethree']) != 0)
                    @foreach($dishes[$j+1]['typethree'] as $typethree)
                        {{ $typethree->name }}
                    @endforeach
                    <br>
                @endif
                @if(count($dishes[$j+1]['typefour']) != 0)
                    @foreach($dishes[$j+1]['typefour'] as $typefour)
                        {{ $typefour->name }}
                    @endforeach
                    <br>
                @endif
                @if(count($dishes[$j+1]['taste']) != 0)
                    @foreach($dishes[$j+1]['taste'] as $taste)
                        {{ $taste->name }}
                    @endforeach
                    <br>
                @endif
                @foreach($dishes[$j+1]['tableware'] as $tableware)
                    {{ $tableware->name }}
                @endforeach
                <br>
                {{ $dishes[$j+1]['address'] }}
            </td>
            <td align="center" valign="middle">
                {{ $dishes[$j+2]['canteen_name'] }}-{{ $dishes[$j+2]['window_name'] }}-{{ $dishes[$j+2]['dish_name'] }} * {{ $dishes[$j+2]['dish_price'] }}
                <br>
                {{ $dishes[$j+2]['user_name'] }}
                <br>
                {{ $dishes[$j+2]['user_phone'] }}
                <br>
                @if(count($dishes[$j+2]['typeone']) != 0)
                    @foreach($dishes[$j+2]['typeone'] as $typeone)
                        {{ $typeone->name }}
                    @endforeach
                    <br>
                @endif
                @if(count($dishes[$j+2]['typetwo']) != 0)
                    @foreach($dishes[$j+2]['typetwo'] as $typetwo)
                        {{ $typetwo->name }}
                    @endforeach
                    <br>
                @endif
                @if(count($dishes[$j+2]['typethree']) != 0)
                    @foreach($dishes[$j+2]['typethree'] as $typethree)
                        {{ $typethree->name }}
                    @endforeach
                    <br>
                @endif
                @if(count($dishes[$j+2]['typefour']) != 0)
                    @foreach($dishes[$j+2]['typefour'] as $typefour)
                        {{ $typefour->name }}
                    @endforeach
                    <br>
                @endif
                @if(count($dishes[$j+2]['taste']) != 0)
                    @foreach($dishes[$j+2]['taste'] as $taste)
                        {{ $taste->name }}
                    @endforeach
                    <br>
                @endif
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
                {{ $dishes[$k]['canteen_name'] }}-{{ $dishes[$k]['window_name'] }}-{{ $dishes[$k]['dish_name'] }} * {{ $dishes[$k]['dish_price'] }}
                <br>
                {{ $dishes[$k]['user_name'] }}
                <br>
                {{ $dishes[$k]['user_phone'] }}
                <br>
                @if(count($dishes[$k]['typeone']) != 0)
                    @foreach($dishes[$k]['typeone'] as $typeone)
                        {{ $typeone->name }}
                    @endforeach
                    <br>
                @endif
                @if(count($dishes[$k]['typetwo']) != 0)
                    @foreach($dishes[$k]['typetwo'] as $typetwo)
                        {{ $typetwo->name }}
                    @endforeach
                    <br>
                @endif
                @if(count($dishes[$k]['typethree']) != 0)
                    @foreach($dishes[$k]['typethree'] as $typethree)
                        {{ $typethree->name }}
                    @endforeach
                    <br>
                @endif
                @if(count($dishes[$k]['typefour']) != 0)
                    @foreach($dishes[$k]['typefour'] as $typefour)
                        {{ $typefour->name }}
                    @endforeach
                    <br>
                @endif
                @if(count($dishes[$k]['taste']) != 0)
                    @foreach($dishes[$k]['taste'] as $taste)
                        {{ $taste->name }}
                    @endforeach
                    <br>
                @endif
                @foreach($dishes[$k]['tableware'] as $tableware)
                    {{ $tableware->name }}
                @endforeach
                <br>
                {{ $dishes[$k]['address'] }}
            </td>
        @endfor
    </tr>
</table>
</body>
</html>
