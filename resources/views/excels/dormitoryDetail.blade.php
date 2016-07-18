<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>宿舍明细表</title>
</head>
<body>
<tr>
    <td>用户名</td>
    <td>手机号</td>
    <td>地址</td>
    <td>菜名*数量</td>
</tr>
@foreach($datas as $data)
    <tr>
        <td>{{ $data->user_name }}</td>
        <td>{{ $data->user_phone }}</td>
        <td>{{ $data->dormitory->floor->building->name }}-
            {{ $data->dormitory->floor->name }}-{{ $data->dormitory->name }}</td>
        <td>
            @foreach($data->dishes as $dish)
                {{ $data->name }} * {{ $data->pivot->num }}
            @endforeach
        </td>
    </tr>
@endforeach
</body>
</html>