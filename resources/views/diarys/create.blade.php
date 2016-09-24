@extends('layout')
@section('pageTitle')<title>Mami Project - 飲食日記 - 本日記錄</title>@stop
<!-- pageCss -->
@section('pageCss')
<link rel="stylesheet" href="{{ asset('css/normalize.css') }}" />
<link rel="stylesheet" href="{{ asset('css/ion.rangeSlider.css') }}" />
<link rel="stylesheet" href="{{ asset('css/ion.rangeSlider.skinFlat.css') }}" />
@stop
<!-- pageJs -->
@section('pageJs')
<script language="javascript" type="text/javascript" src="{{ asset('js/ion.rangeSlider.js') }}"></script>
@stop
<!-- pageContent -->
@section('content')
<div class="container">
    {!! Form::open(['url'=>'/diarys/store', 'method'=>'post']) !!}
    <div id="includePage">
        <div class="btn-back">
            <button type="button" class="btn btn-sm btn-default btn-block" id="back" onclick="location.href='{{ asset('/diarys') }}'">
            ← 返回</button>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                新增今日飲食紀錄- {{ $date }} ({{ $week }})
        		{!! Form::hidden('title', $value = $date) !!}
        		{!! Form::hidden('storeType', $value = 'C') !!}
                </h3>
            </div>
            <div class="panel-body">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
	            			<div data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
	            				<h4 class="panel-title">早餐</h4>
	            			</div>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="true">
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">早餐-餐點</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('b_food', $value = null, ['class' => 'form-control', 'placeholder' => '早餐吃的東西']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">全穀根莖類</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('b_grains', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">低脂乳品類</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('b_dairy', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">水果類</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('b_fruits', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">豆魚肉蛋</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('b_protein', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">蔬菜類</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('b_vegetables', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
	            			<div class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
	            				<h4 class="panel-title">中餐</h4>
	            			</div>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">中餐-餐點</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('l_food', $value = null, ['class' => 'form-control', 'placeholder' => '中餐吃的東西']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">全穀根莖類</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('l_grains', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">低脂乳品類</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('l_dairy', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">水果類</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('l_fruits', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">豆魚肉蛋</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('l_protein', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">蔬菜類</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('l_vegetables', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
					        <div class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					        	<h4 class="panel-title">晚餐</h4>
					        </div>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">晚餐-餐點</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('d_food', $value = null, ['class' => 'form-control', 'placeholder' => '晚餐吃的東西']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">全穀根莖類</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('d_grains', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">低脂乳品類</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('d_dairy', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">水果類</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('d_fruits', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">豆魚肉蛋</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('d_protein', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">蔬菜類</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('d_vegetables', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFour">
					        <div class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
					        	<h4 class="panel-title">其他(非正餐)</h4>
					        </div>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">其他-餐點</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('o_food', $value = null, ['class' => 'form-control', 'placeholder' => '非正餐吃的東西']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">全穀根莖類</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('o_grains', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">低脂乳品類</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('o_dairy', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">水果類</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('o_fruits', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">豆魚肉蛋</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('o_protein', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="max-width:100px;">
                                                <div align="center">蔬菜類</div>
                                            </td>
                                            <td>
                                                <div style="padding:0px 5px 0px 5px;">
                                                    {!! Form::text('o_vegetables', $value = 0, ['class' => 'form-control rangeBar']) !!}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::hidden('created_name','SYSTEM') !!} {!! Form::submit('存檔',['class'=>'btn btn-success form-control']) !!} {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.menu-diarys').addClass('active');
});
$(function() {
    $('.rangeBar').ionRangeSlider({
        hide_min_max: true,
        min:0,
        max:5,
        step:0.5,
        postfix:"",
        grid: true,
        grid_num: 5
    });
});
</script>
@stop
