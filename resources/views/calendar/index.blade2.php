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
                    <span id="setMcDateBtn" data-action="goToday" data-toggle="modal" data-target="#setMcDate"> [設定]</i></span>
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
            <!-- 本日事件 -->
            <div class="calendar-event">
            @if($calendarEvent['set']=='N')
                <button type="button" class="btn btn-xs btn-default btn-block" id="setEventBtn" data-toggle="modal" data-target="#setEvent">+新增點選日事件</button>
            @else
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <div class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h4 class="panel-title">本日事件[{!!$calendarEvent['title']!!}]</h4>
                        </div>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="height: 0px;">
                        <div class="panel-body">
                            <p>{!!$calendarEvent['id']!!}</p>
                            <p>{!!$calendarEvent['title']!!}</p>
                            <p>{!!$calendarEvent['phone']!!}</p>
                            <p>{!!$calendarEvent['addr']!!}</p>
                            <p>{!!$calendarEvent['note']!!}</p>
                        </div>
                    </div>
                </div>
            @endif
            </div>
        </div>
        <!-- 孕期歷程 -->
        <div class="col-sm-7 col-xs-12 calendar-note">
            <div class="panel panel-default">
                <div class="panel-heading"><b class="note-week">{!!$calendarNote['week'] . $calendarNote['date']!!}</b></div>
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
</div>

<!-- 孕期日曆-設定窗 -->
<div class="modal fade" id="setMcDate" tabindex="-1" role="dialog" aria-labelledby="setMcDateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="setMcDateLabel">孕期日曆-設定</h4>
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

<!-- 日曆事件-設定窗 -->
<div class="modal fade" id="setEvent" tabindex="-1" role="dialog" aria-labelledby="setEventLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="setEventLabel">日曆事件</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="input-group enentInput" id="datepicker">
                            <span class="input-group-addon">日期</span>
                            <input type="text" class="input-sm form-control" id="eventDate" value="{!!$calendarNote['date']!!}" required disabled/>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="input-group enentInput">
                            <span class="input-group-addon">標題</span>
                            <input type="text" class="input-sm form-control" id="eventTitle" value="" required/>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="input-group enentInput">
                            <span class="input-group-addon">電話</span>
                            <input type="text" class="input-sm form-control" id="eventPhone" value="" required/>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="input-group enentInput">
                            <span class="input-group-addon">地址</span>
                            <input type="text" class="input-sm form-control" id="eventAddr" value="" required/>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="input-group enentInput">
                            <span class="input-group-addon">備註</span>
                            <textarea class="form-control" rows="3" id="eventText" value=""></textarea>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <span id="setEventMessage"></span>
                <input type="submit" id="setEventSubmit" class="btn btn-sm" data-action="setEvent" data-dismiss="N" value="儲存">
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
        //設定事件-檢查
        $('body').on('click change', '#setEventSubmit, #eventTitle', function(){
            var eventTitle = $('#eventTitle').val().trim();
            if(eventTitle.length != 0){
                $('#setEventMessage').html('');
                $('#setEventSubmit').addClass('btn-success');
                $('#setEventSubmit').attr('data-dismiss','modal');
            }else{
                $('#setEventMessage').html('請輸入標題');
                $('#setEventSubmit').removeClass('btn-success');
                $('#setEventSubmit').attr('data-dismiss','N');
            };
        });
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
        //點選日期 & 點選回到今日
        $('.calendar-box').on('click','li, #goToday',CalendarAction);
        //重設經期資訊
        $('.modal-footer').on('click','#setMcDateSubmit, #goToday',CalendarAction);
    });
});

function CalendarAction () {
    /*取得點擊資訊*/
    var action  = $(this).attr('data-action');
    /*
    ** (0)setEvent:新增事件屬性設定
    ** (1)changeMcDate:重設經期資訊，重置事件日為今天
    ** (2)week-event:依據點擊年月日及最後經期日推算事件日
    ** (3)goToday:切換到執行日的月份
    ** (4)prev:切換為上個月
    ** (5)next:切換為下個月
    */
    //(0)setEvent:新增事件屬性設定
    if(action == 'setEvent'){
        var eventDate  = $('#eventDate').val();
        var eventTitle = $('#eventTitle').val();
        var eventPhone = $('#eventPhone').val();
        var eventAddr  = $('#eventAddr').val();
        var eventText  = $('#eventText').val();
        actionData = {
            'eventDate'  : eventDate,
            'eventTitle' : eventTitle,
            'eventPhone' : eventPhone,
            'eventAddr'  : eventAddr,
            'eventText'  : eventText
        };
    }
    //(1~5)日曆動作屬性設定
    else{
        var mcDate  = $('#mcDate').val();
        var mcCycle = $('#mcCycle').val();
        var year    = $('#year').attr('data-year');
        var month   = $('#month').attr('data-month');
        var day     = $(this).attr('data-day');
        //若為點選日期，則設定選中效果，並帶入事件日中
        if(action == 'week-event'){
            $(this).parents('ul').find('span').removeClass('day-clicked');
            $(this).find('span').addClass('day-clicked');
            $('#eventDate').val(year + '-' + month + '-' + day);
        };
        actionData = {
            'action'  : action,
            'mcDate'  : mcDate,
            'mcCycle' : mcCycle,
            'year'    : year,
            'month'   : month,
            'day'     : day
        };
    }

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
            if(action == 'setEvent'){

            }
            if(action == 'week-event' || action == 'changeMcDate' || action == 'goToday'){
                $('.note-week').html(data['week'] + data['date']);
                $('.note-1').html(data['content1']);
                $('.note-2').html(data['content2']);
                $('.note-3').html(data['content3']);
                $('.note-4').html(data['content4']);
                $('#dueDate').html(data['dueDate']);
                $('#eventDate').val(data['date']);
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
