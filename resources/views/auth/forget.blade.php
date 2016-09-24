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
<div class="container" style="margin-top:40px;">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-sm-offset-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <strong> Mami Project </strong>
                </div>
                <div class="panel-body">
                    <div class="row" style="text-align: center;">
                        <span class="icon-size">
                            <i class="glyphicon glyphicon-question-sign"></i>
                        </span>
                    </div>
                    <form class="form-horizontal" role="form" method="POST" action="{{ asset('/forget') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col-xs-10 col-xs-offset-1">
                        	<BR>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-envelope"></i>
                                    </span>
                                    <input class="form-control login-input" placeholder="請輸入Eemail" name="email" type="email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <BR>
                            <div class="form-group">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-md btn-success btn-block" value="發送密碼重置信">
                                </div>
                            </div>
                            @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                            @endif @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="panel-footer" style="padding:10px;text-align:center;">
                    想起密碼了 ? <a href="{{ asset('/login') }}" onClick=""> 點此登入 </a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop