<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>标签</title>
</head>
<body>
<table>
    @for($i=0;$i<floor(($data->order_no)/3);$i++)
        <tr>
            <td align="center" valign="middle" height="70" width="40">{{ $data->dish_name }} 1* {{ $data->dish_price }}
                <br>
                {{ $data->user_name }}<br>
                {{ $data->user_phone }}<br>
                {{ $data->building_name }}.{{ $data->floor_name }}.{{ $data->dormitory_name }}
            </td>
            <td align="center" valign="middle" height="70" width="40">{{ $data->dish_name }} 1* {{ $data->dish_price }}
                <br>
                {{ $data->user_name }}<br>
                {{ $data->user_phone }}<br>
                {{ $data->building_name }}.{{ $data->floor_name }}.{{ $data->dormitory_name }}
            </td>
            <td align="center" valign="middle" height="70" width="40">{{ $data->dish_name }} 1* {{ $data->dish_price }}
                <br>
                {{ $data->user_name }}<br>
                {{ $data->user_phone }}<br>
                {{ $data->building_name }}.{{ $data->floor_name }}.{{ $data->dormitory_name }}
            </td>
        </tr>
    @endfor
        <tr>
            @for($i=0;$i<(($data->order_no)%3);$i++)

            <td align="center" valign="middle" height="70" width="40">{{ $data->dish_name }} 1* {{ $data->dish_price }}
                <br>
                {{ $data->user_name }}<br>
                {{ $data->user_phone }}<br>
                {{ $data->building_name }}.{{ $data->floor_name }}.{{ $data->dormitory_name }}
            </td>
            @endfor

        </tr>
</table>
</body>
</html>
