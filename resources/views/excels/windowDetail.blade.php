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
        <td>需支付金钱</td>
    </tr>
    @foreach($datas as $data)
        @foreach($data->dishes as $dish)
            <tr>
                <td>{{ $data->window->canteen->name }}</td>
                <td>{{ $data->window->name }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->pivot->num }}</td>
                <td>{{ ($data->price)*() }}</td>
            </tr>
        @endforeach
    @endforeach
</table>
</body>
</html>