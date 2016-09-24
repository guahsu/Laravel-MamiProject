@extends('layout')
<!-- pageTtile -->
@section('pageTitle')
<title>Mami Project - 孕期日曆</title>
@stop
<!-- pageCss -->
@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.min.css') }}">
@stop
<!-- pageJs -->
@section('pageJs')
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
<!-- pageContent -->
@section('content')
<div class="container">
<!-- 孕期日曆 -->
    <div class="row">
        <div class="col-sm-5 col-xs-12 calendar-box">
            <!-- 日曆-頂部 -->
            <div class="head">
                <ul>
                    <li class="prev" data-action="prev"><span class="glyphicon glyphicon-chevron-left"></span></li>
                    <li class="next" data-action="next"><span class="glyphicon glyphicon-chevron-right"></span></li>
                    <li style="text-align:center">
                        <span id="year" data-year="{!!$calendar['dataYear']!!}">{!!$calendar['displayYear']!!}</span>
                        <br>
                        <span id="month" data-month="{!!$calendar['dataMonth']!!}">{!!$calendar['displayMonth']!!}</span>
                    </li>
                </ul>
            </div>
            <!-- 日曆-設定資訊 -->
            <div class="calender-info">
                <div class="calender-info-left">
                    <a href="#" onclick="return false">
                    <span id="goToday" data-action="goToday"><i class="info-today glyphicon glyphicon-stop"></i> TODAY</span>
                    </a>
                </div>
                <div class="calendar-info-right">
                    <span id="dueDate">{!!$calendar['dueDate']!!} </span>
                    <a href="#" onclick="return false">
                    <span id="setMcDateBtn" data-action="goToday" data-toggle="modal" data-target="#myModal"> [設定]</i></span>
                    </a>
                </div>
                <div style="clear: both;"></div>
            </div>
            <!-- 日曆-日期盤 -->
            <ul class="weekdays">
                <li>Mo</li>
                <li>Tu</li>
                <li>We</li>
                <li>Th</li>
                <li>Fr</li>
                <li>Sa</li>
                <li>Su</li>
            </ul>
            <ul class="days">
            {!!$calendar['days']!!}
            </ul>
        </div>
        <!-- 孕期歷程 -->
        <div class="col-sm-7 col-xs-12 calendar-eventbox">
        <div class="panel panel-default">
            <div class="panel-heading"><b class = "note-week">{!!$calendarNote['title']!!}</b></div>
                <div class="panel-body">
                    <p><b class="note-title">孕婦生理變化</b></p>
                    <p class="note-1">{!!$calendarNote['content1']!!}</p>
                    <p><b class="note-title">胎兒發育成長</b></p>
                    <p class="note-2">{!!$calendarNote['content2']!!}</p>
                    <p><b class="note-title">相關飲食</b></p>
                    <p class="note-3">{!!$calendarNote['content3']!!}</p>
                    <p><b class="note-title">注意事項</b></p>
                    <p class="note-4">{!!$calendarNote['content4']!!}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 孕期日曆-設定窗 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">孕期日曆-設定</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    @if(Auth::check())
                    <div class="col-sm-6 col-xs-12">
                        <div class="input-group" id="datepicker">
                            <span class="input-group-addon">最後經期日</span>
                            <input type="button" class="input-sm form-control" id="mcDate" value="{{ Auth::user()->mc_date }}" required/>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="input-group mcCycle">
                            <span class="input-group-addon">平均週期天</span>
                            <input type="number" class="input-sm form-control" id="mcCycle" value="{{ Auth::user()->mc_cycle }}" min="1"  max="90" required/>
                        </div>
                    </div>
                    @else
                    <div class="col-sm-6 col-xs-12">
                        <div class="input-group" id="datepicker">
                            <span class="input-group-addon">最後經期日</span>
                            <input type="button" class="input-sm form-control" id="mcDate" value="{{date('Y-m-d')}}" required/>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <div class="input-group mcCycle">
                            <span class="input-group-addon">平均週期天</span>
                            <input type="number" class="input-sm form-control" id="mcCycle" value="28" min="1"  max="90" required/>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <span id="setMcDateMessage"></span>
                <input type="submit" id="setMcDateSubmit" class="btn btn-sm" data-action="changeMcDate" data-dismiss="N" value="設定">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    //大MENU選單-選中效果
    $('.menu-calendar').addClass('active');
    //日曆動作
    $(window).load(function() {
        //重設日期-檢查
        $('body').on('click change','#setMcDateBtn, #mcCycle',function(){
            var mcCycle = $('#mcCycle').val();
            if(mcCycle > 0 && mcCycle < 90){
                $('#setMcDateMessage').html('');
                $('#setMcDateSubmit').addClass('btn-success');
                $('#setMcDateSubmit').attr('data-dismiss','modal');
            }else{
                $('#setMcDateMessage').html('請輸入正確的週期天數(1~90)');
                $('#setMcDateSubmit').removeClass('btn-success');
                $('#setMcDateSubmit').attr('data-dismiss','N');
            };
        });
        //點選日期, 回到今日
        $('.calendar-box').on('click','li, #goToday',CalendarAction);
        //重設經期資訊
        $('.modal-footer').on('click','#setMcDateSubmit, #goToday',CalendarAction);
    });
});

function CalendarAction () {
    //取得動作
    var action = $(this).attr('data-action');
    //若為點選日期，則設定選中效果
    if(action == 'week-event'){
        $(this).parents('ul').find('span').removeClass('day-clicked');
        $(this).find('span').addClass('day-clicked');
    };
    //傳送資料
    actionData = {
        'action'  : action,
        'mcDate'  : $('#mcDate').val(),
        'mcCycle' : $('#mcCycle').val(),
        'year'    : $('#year').attr('data-year'),
        'month'   : $('#month').attr('data-month'),
        'day'     : $(this).attr('data-day')
    };
    //執行動作
    $.ajax({
        url: '{{ asset("/calendar/action") }}',
        type: 'POST',
        data: actionData,
        async: true,
        cache: false,
        beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');
            if (token) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
        success: function(data){
            if(action == 'week-event' || action == 'changeMcDate' || action == 'goToday'){
                $('.note-week').html(data['title']);
                $('.note-1').html(data['content1']);
                $('.note-2').html(data['content2']);
                $('.note-3').html(data['content3']);
                $('.note-4').html(data['content4']);
                $('#dueDate').html(data['dueDate']);
            };
            if(action == 'prev' || action == 'next' || action == 'goToday'){
                $('#year').attr('data-year', data['dataYear']);
                $('#year').html(data['displayYear']);
                $('#month').attr('data-month', data['dataMonth']);
                $('#month').html(data['displayMonth']);
                $('.days').html(data['days']);
            };
        },
        error: function(){
          alert('啊啊...這功能好像出問題了。');
        }
    });
};
</script>
@stop
