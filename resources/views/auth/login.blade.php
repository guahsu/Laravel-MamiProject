@extends('loginLayout')
@section('pagecss')
<style type="text/css">
    body {
        font-family: Microsoft JhengHei;
        background-color: #2c3e50;
    }
    .container {
        max-width: 900px;
    }
    .panel-heading {
        padding: 5px 15px;
    }
    .panel-footer {
        padding: 1px 15px;
        color: #A0A0A0;
    }
    .img-size {
        width: 140px;
        padding: 15px 15px 15px 15px;
    }
    .login-input {
        height: 38px;
    }
    .icon-size {
        color: #18bc9c;
        font-size: 90px;
    }
</style>
@stop
@section('content')
<div class="container" style="margin-top:40px;">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-sm-offset-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <strong> Mami Project </strong>
                </div>
                <div class="panel-body">
                    <form role="form" action="{{ asset( '/login') }}" method="POST">
                    {!! csrf_field() !!}
                        <div class="row" style="text-align: center;padding-bottom:20px;">
                            <img src="{{ asset( 'img/gary_bk.png') }}" class="img-size img-circle ">
                        </div>
                        <div class="row">
                            <div class="col-xs-10 col-xs-offset-1">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-envelope"></i>
                                        </span>
                                        @if(Request::path() == 'DEMO')
                                        <input class="form-control login-input" placeholder="Email" name="email" type="email" value="demo@guastudio.com" autofocus required>
                                        @else
                                        <input class="form-control login-input" placeholder="Email" name="email" type="email" value="{{ old( 'email') }}" autofocus required>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-lock"></i>
                                        </span>
                                        @if(Request::path() == 'DEMO')
                                        <input class="form-control login-input" placeholder="Password" name="password" type="password" value="demopwd" required>
                                        @else
                                        <input class="form-control login-input" placeholder="Password" name="password" type="password" value="" required>
                                        @endif
                                    </div>
                                    <div style="text-align:right;">
                                    <a href="{{ asset( '/forget') }}" onClick="" style="font-size:13px">忘記密碼?</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-md btn-success btn-block" value="登入">
                                </div>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer" style="padding:10px;text-align:center;">
                    還沒有帳號 ? <a href="{{ asset( '/register') }}" onClick=""> 註冊一個吧! </a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
