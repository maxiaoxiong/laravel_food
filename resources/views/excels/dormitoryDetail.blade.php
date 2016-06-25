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
    <td>菜名</td>
    <td>数量</td>
</tr>
@foreach($datas as $data)
    <tr>
        <td>{{ $data->user_name }}</td>
        <td>{{ $data->phone }}</td>
        <td>{{ $data->building_name }}-{{ $data->floor_name }}-{{ $data->dormitory_name }}</td>
        <td>{{ $data->dish_name }}</td>
        <td>{{ $data->order_no }}</td>
    </tr>
@endforeach
</body>
</html>