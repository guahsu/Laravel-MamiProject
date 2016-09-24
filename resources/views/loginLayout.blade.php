<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <meta name="author" content="GuaHsu">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image" content="" />
    <meta property="og:description" content="">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>Mami Project </title>
    <!--JS-->
    <script language="javascript" type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('js/analyticstracking.js') }}"></script>
    @yield('pagejs')
    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    @yield('pagecss')
</head>

<body>
    @yield('content')
</body>

</html>
