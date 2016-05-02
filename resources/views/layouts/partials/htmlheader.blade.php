<head>
    <meta charset="UTF-8">
    <title> AdminLTE 2 with Laravel - @yield('htmlheader_title', 'Your title here') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    {{--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />--}}
    {{--<link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}" type="text/css">--}}
    <link href="//cdn.bootcss.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    {{--<link rel="stylesheet" href="{{ asset('/fonts/fontawesome-webfont.woff2?v=4.3.0') }}">--}}
    <!-- Ionicons -->
    {{--<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset('/css/ionicons.min.css') }}" rel="stylesheet" type="text/css">--}}
    <link href="//cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link href="{{ asset('/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset('/css/skins/skin-blue.css') }}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{ asset('/plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('/plugins/croppic/main.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/plugins/croppic/croppic.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('/css/bootstrap-timepicker.css') }}">

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

    <script>
        function getWindows(canteen_id){
            $.getJSON('/getWindows/'+canteen_id,function(data){
                var str = "";
                for (var i=0;i<data.length;i++){
                    str+="<option value="+data[i].id+">"+data[i].window_name+"</option>"
                }
                $('#window_id').html(str);
            })
        }

        function getFloors(building_id){
            $.getJSON('/getFloors/'+building_id,function(data){
                var str = "";
                for (var i=0;i<data.length;i++){
                    str+="<option value="+data[i].id+">"+data[i].floor_name+"</option>"
                }
                $('#floor_id').html(str);
            })
        }
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
