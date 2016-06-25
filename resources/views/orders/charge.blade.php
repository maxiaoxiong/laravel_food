<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Charge</title>
    <script src="/js/pingpp-pc.js"></script>
</head>
<body>
<script>
    var charge = {!! $charge !!};
        pingppPc.createPayment(charge, function(result, err){
        // 处理错误信息ing
    });
</script>
</body>
</html>