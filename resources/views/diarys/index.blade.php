@extends('layout')
@section('pageTitle')<title>Mami Project - 飲食日記</title>@stop
<!-- pageCss -->
@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/normalize.css') }}" />
<link rel="stylesheet" href="{{ asset('css/ion.rangeSlider.css') }}" />
<link rel="stylesheet" href="{{ asset('css/ion.rangeSlider.skinFlat.css') }}" />
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/diarys.css') }}">
@stop
<!-- pageJs -->
@section('pageJs')
<script language="javascript" type="text/javascript" src="{{ asset('js/ion.rangeSlider.js') }}"></script>
<script language="javascript" type='text/javascript' src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type='text/javascript'>
$(function(){
    $('.input-daterange').datepicker({
    autoclose: true ,
    format: 'yyyy/mm/dd',
    disableTouchKeyboard: true
    });
});
</script>
@stop
<!-- pageContent -->
@section('content')
    <div class="container">
        <div id="includePage">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">飲食日記</h3>
                </div>
                <div class="panel-body row">
                    <!--  -->
                    <div class="col-sm-6 col-xs-12 head-tools">
                        <div class="input-daterange input-group" id="datepicker">
                            <span class="input-group-addon">日期</span>
                            <input type="text" class="input-sm form-control inputDate" id="dateFrom" name="from" placeholder="起始日"/>
                            <span class="input-group-addon">-</span>
                            <input type="text" class="input-sm form-control inputDate" id="dateTo" name="to" placeholder="結束日"/>
                        </div>
                    </div>
                    <!--  -->
                    <div class="col-sm-6 col-xs-12  head-tools">
                        達成：
                        <div class="btn-group btn-search">
                            <button type="button" class="btn btn-sm btn-default selectOption" id="goalYn" data-bind="label" data-value="%">-- 選擇 --</button>
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu goalYn">
                                <li><a href="#" data-value="%">全部</a></li>
                                <li><a href="#" data-value="Y">是</a></li>
                                <li><a href="#" data-value="N">否</a></li>
                            </ul>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary" id="search"> 查詢 </button>
                    </div>
                </div>
            </div>
            <!-- 內容區 -->
            <div class="btn-create">
                <button type="button" class="btn btn-md btn-success" id="create" onclick="location.href='{{ asset('/diarys/create') }}'">
                新增本日記錄</button>
            </div>
            <div class="table-responsive tableScroll">
                <table class="table-box table table-bordered">
                    <thead>
                        <tr>
                            <th style="display:none;">ID</th>
                            <th width="12%">日期</th>
                            <th width="16%">早餐</th>
                            <th width="16%">中餐</th>
                            <th width="16%">晚餐</th>
                            <th width="16%">其他</th>
                            <th width="10%">達成</th>
                            <th width="10%">詳細</th>
                        </tr>
                    </thead>
                    <tbody class="dataList">
                        @foreach($diarys as $diary)
                        <!-- 資料列 -->
                        <tr>
                            <td class="diary_id" style="display:none;">{{ $diary->id }}</td>
                            <td class="tableSpace text-center">{{ $diary->title }}</td>
                            <td class="tableSpace">{{ $diary->breakfast }}</td>
                            <td class="tableSpace">{{ $diary->lunch }}</td>
                            <td class="tableSpace">{{ $diary->dinner }}</td>
                            <td class="tableSpace">{{ $diary->otder }}</td>
                            <td class="tableSpace text-center">{{ $diary->goal == 'Y' ? '是' : '否'}}</td>
                            <td class="tableSpace text-center">
                                <button type="button" class="btn btn-xs btn-info viewDt btn-block"> 顯示 </button>
                            </td>
                        </tr>
                        <tr class="dt-box" dt-box="{{ $diary->id }}" style="display: none;">
                            <!-- 資料明細 -->
                            <td colspan="7">
                                <div class="dt-row" dt-row="{{ $diary->id }}">
                                    <table class="table table-bordered">
                                        <tbody class="dtList">
                                            <tr>
                                                <td class="text-center grains"     width="20%" colspan="4">全穀根莖類 (2 ~ 4.5碗)</td>
                                                <td class="text-center dairy"      width="20%" colspan="4">低脂乳品類 (1.5杯)</td>
                                                <td class="text-center fruits"     width="20%" colspan="4">水果類 (2 ~ 4份)</td>
                                                <td class="text-center protein"    width="20%" colspan="4">豆魚肉蛋類 (4 ~ 7.5份)</td>
                                                <td class="text-center vegetables" width="20%" colspan="4">蔬菜類 (3 ~ 5份)</td>
                                            </tr>
                                            <tr class="p-bar">
                                                <td colspan="4">
                                                    <input class="form-control grains-bar" type="text" value="{{ $diary->b_grains + $diary->l_grains + $diary->d_grains + $diary->o_grains }}">
                                                </td>
                                                <td colspan="4">
                                                    <input class="form-control dairy-bar" type="text" value="{{ $diary->b_dairy + $diary->l_dairy + $diary->d_dairy + $diary->o_dairy }}">
                                                </td>
                                                <td colspan="4">
                                                    <input class="form-control fruits-bar" type="text" value="{{ $diary->b_fruits + $diary->l_fruits + $diary->d_fruits + $diary->o_fruits }}">
                                                </td>
                                                <td colspan="4">
                                                    <input class="form-control protein-bar" type="text" value="{{ $diary->b_protein + $diary->l_protein + $diary->d_protein + $diary->o_protein }}">
                                                </td>
                                                <td colspan="4">
                                                    <input class="form-control vegetables-bar" type="text" value="{{ $diary->b_vegetables + $diary->l_vegetables + $diary->d_vegetables + $diary->o_vegetables }}">
                                                </td>
                                            </tr>
                                            <tr class="p-number">
                                                <td width="5%">早</td>
                                                <td width="5%">中</td>
                                                <td width="5%">晚</td>
                                                <td width="5%">其</td>
                                                <td width="5%">早</td>
                                                <td width="5%">中</td>
                                                <td width="5%">晚</td>
                                                <td width="5%">其</td>
                                                <td width="5%">早</td>
                                                <td width="5%">中</td>
                                                <td width="5%">晚</td>
                                                <td width="5%">其</td>
                                                <td width="5%">早</td>
                                                <td width="5%">中</td>
                                                <td width="5%">晚</td>
                                                <td width="5%">其</td>
                                                <td width="5%">早</td>
                                                <td width="5%">中</td>
                                                <td width="5%">晚</td>
                                                <td width="5%">其</td>
                                            </tr>
                                            <tr class="p-number">
                                                <td>{{ $diary->b_grains }}</td>
                                                <td>{{ $diary->l_grains }}</td>
                                                <td>{{ $diary->d_grains }}</td>
                                                <td>{{ $diary->o_grains }}</td>
                                                <td>{{ $diary->b_dairy }}</td>
                                                <td>{{ $diary->l_dairy }}</td>
                                                <td>{{ $diary->d_dairy }}</td>
                                                <td>{{ $diary->o_dairy }}</td>
                                                <td>{{ $diary->b_fruits }}</td>
                                                <td>{{ $diary->l_fruits }}</td>
                                                <td>{{ $diary->d_fruits }}</td>
                                                <td>{{ $diary->o_fruits }}</td>
                                                <td>{{ $diary->b_protein }}</td>
                                                <td>{{ $diary->l_protein }}</td>
                                                <td>{{ $diary->d_protein }}</td>
                                                <td>{{ $diary->o_protein }}</td>
                                                <td>{{ $diary->b_vegetables }}</td>
                                                <td>{{ $diary->l_vegetables }}</td>
                                                <td>{{ $diary->d_vegetables }}</td>
                                                <td>{{ $diary->o_vegetables }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <!-- END 資料列 -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    //查詢
    $(document).ready(function() {
        //選單效果
        $('.menu-diarys').addClass('active');
        //搜尋
        $('#search').click(function(){
            searchData = {
             'dateFrom' : $('#dateFrom').val(),
             'dateTo'   : $('#dateTo').val(),
             'goalYn'   : $('#goalYn').attr('data-value')
            };
            $.ajax({
                url:'{{ asset("/diarys/search") }}',
                type:'POST',
                data: searchData,
                async: false,
                beforeSend: function (xhr) {
                  var token = $('meta[name="csrf_token"]').attr('content');
                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
                },
                success: function(data){
                  $('.dataList').html(data);
                },
                error: function(){
                  alert('啊..好像出錯了..');
                }
            });
        });
    });
    </script>
    <script language="javascript" type="text/javascript" src="{{ asset('/js/diary_list.js') }}"></script>
@stop
