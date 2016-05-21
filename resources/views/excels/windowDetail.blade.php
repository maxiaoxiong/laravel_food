<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>窗口明细表</title>
</head>
<body>
<table>
    <tr>
        <td>餐厅名</td>
        <td>窗口名</td>
        <td>菜名</td>
        <td>份数</td>
    </tr>
    @foreach($datas as $data)
        <tr>
            <td>{{ $data->canteen_name }}</td>
            <td>{{ $data->window_name }}</td>
            <td>{{ $data->dish_name }}</td>
            <td>{{ $data->order_no }}</td>

        </tr>
    @endforeach
</table>
</body>
</html>