@extends('loginLayout')
@section('pagejs')
<script language="javascript" type='text/javascript' src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type='text/javascript'>
$(function(){
    $('#mcDate').datepicker({
        autoclose: true ,
        format: 'yyyy-mm-dd',
        disableTouchKeyboard: true
    });
});
</script>
@stop
@section('pagecss')
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.min.css') }}">
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
    .login-input {
        height: 38px;
    }
    .icon-size {
        color: #18bc9c;
        font-size: 60px;
    }
</style>
@stop
@section('content')
<div class="container" style="margin-top:40px;"">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-sm-offset-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <strong> Mami Project </strong>
                </div>
                <div class="panel-body">
                    <div class="row" style="text-align: center;">
                        <span class="icon-size">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </span>
                    </div>
                    <form role="form" action="{{ asset( '/register') }}" method="POST">
                    {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-xs-10 col-xs-offset-1">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-user"></i>
                                        </span>
                                        <input class="form-control login-input" placeholder="請輸入名稱" name="name" type="text" value="{{ old( 'name') }}" autofocus required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-envelope"></i>
                                        </span>
                                        <input class="form-control login-input" placeholder="請輸入Eemail" name="email" type="email" value="{{ old( 'email') }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-lock"></i>
                                        </span>
                                        <input class="form-control login-input" placeholder="請輸入密碼" name="password" type="password" value="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-repeat"></i>
                                        </span>
                                        <input class="form-control login-input" placeholder="請再次輸入密碼" name="password_confirmation" type="password" value="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-calendar"></i>
                                        </span>
                                        <input class="form-control login-input" placeholder="請選擇最後經期日" name="mcDate" id="mcDate" type="text" value="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-time"></i>
                                        </span>
                                        <input class="form-control login-input" placeholder="請輸入平均週期日" name="mcCycle" type="number" min="1" max="90" value="" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-md btn-success btn-block" value="註冊">
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
                    已經有帳號了 ? <a href="{{ asset( '/login') }}" onClick=""> 點此登入 </a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
