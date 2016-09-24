<!DOCTYPE html>
<html lang="zh-TW">
<head>
<meta charset="utf-8">
<meta name="author" content="GuaHsu">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:image" content=""/>
<meta property="og:description" content="">
<meta name="csrf_token" content="{{ csrf_token() }}" />
@yield('pageTitle')
<!--CSS-->
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
@yield('pageCss')
<!--JS-->
<script language="javascript" type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('js/analyticstracking.js') }}"></script>
@yield('pageJs')
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
  <div class="menubar">
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container" id="menubar">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ asset('/') }}">MAMI Project</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="menu-calendar"><a href="{{ asset('/calendar') }}">孕期日曆</a></li>
            <li class="menu-diarys"><a href="{{ asset('/diarys') }}">飲食日記</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          @if(Auth::check())
            <li class="menu-user hidden-sm hidden-xs"><a href="#">{{ Auth::user()->name }}</a></li>
            <li><a href="{{ asset('/logout') }}">[登出]</a></li>
          @endif
          </ul>
        </div>
      </div>
    </nav>
  </div>
@yield('content')
</body>
</html>
