<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Auth;
use App\Diary;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DiarysController extends Controller
{
  //列表顯示
  public function index()
  {
    $user_id = Auth::id();
    $diarys  = Diary::where('user_id', '=', $user_id)
                    ->orderBy('id','desc')
                    ->get();
    return view('diarys/index',compact('diarys'));
  }

  //列表動作-搜尋
  public function search()
  {
    $user_id  = Auth::id();
    $dateFrom = Input::get('dateFrom');
    $dateTo   = Input::get('dateTo');
    $goalYn   = Input::get('goalYn');
    if(empty($dateFrom)){
        $diarys = Diary::where('user_id', '=', $user_id)
                ->where('goal', 'like', $goalYn)
                ->orderBy('id','desc')
                ->get();
    }else{
        $diarys = Diary::where('user_id', '=', $user_id)
                ->whereBetween('title',  array($dateFrom, $dateTo))
                ->where('goal', 'like', $goalYn)
                ->orderBy('id','desc')
                ->get();
    };
    return view('diarys/lists',compact('diarys'));
  }

  //新增
  public function create()
  {
    $user_id   = Auth::id();
    $date      = date('Y/m/d');
    $weekArray = Array('日','一','二','三','四','五','六');
    $week      = $weekArray[date('w')];
    //判斷今日是否已經建立過資料
    $result = Diary::where('user_id', '=', $user_id)
                   ->where('title'  , '=', $date)
                   ->get();
    //如果有資料，顯示為編輯頁；否則顯示建立頁
    if ($result->first()){
      return view('diarys/edit',compact('result', 'week'));
    }else{
      return view('diarys/create',compact('date', 'week'));
    };
  }

  //存檔&更新
  public function store(Request $request)
  {
    $user_id      = Auth::id();
    $input        = Input::all();
    $storeType    = Input::get('storeType');
    $title        = Input::get('title');
    $breakfast    = Input::get('b_food');
    $lunch        = Input::get('l_food');
    $dinner       = Input::get('d_food');
    $other        = Input::get('o_food');
    $b_grains     = Input::get('b_grains');
    $b_dairy      = Input::get('b_dairy');
    $b_fruits     = Input::get('b_fruits');
    $b_protein    = Input::get('b_protein');
    $b_vegetables = Input::get('b_vegetables');
    $l_grains     = Input::get('l_grains');
    $l_dairy      = Input::get('l_dairy');
    $l_fruits     = Input::get('l_fruits');
    $l_protein    = Input::get('l_protein');
    $l_vegetables = Input::get('l_vegetables');
    $d_grains     = Input::get('d_grains');
    $d_dairy      = Input::get('d_dairy');
    $d_fruits     = Input::get('d_fruits');
    $d_protein    = Input::get('d_protein');
    $d_vegetables = Input::get('d_vegetables');
    $o_grains     = Input::get('o_grains');
    $o_dairy      = Input::get('o_dairy');
    $o_fruits     = Input::get('o_fruits');
    $o_protein    = Input::get('o_protein');
    $o_vegetables = Input::get('o_vegetables');

    //計算是否達標
    $grains     = $b_grains  + $l_grains  + $d_grains  + $o_grains;
    $dairy      = $b_dairy   + $l_dairy   + $d_dairy   + $o_dairy;
    $fruits     = $b_fruits  + $l_fruits  + $d_fruits  + $o_fruits;
    $protein    = $b_protein + $l_protein + $d_protein + $o_protein;
    $vegetables = $b_vegetables + $l_vegetables + $d_vegetables + $o_vegetables;

    if($grains-2<0 || $dairy-1.5<0 || $fruits-2<0 || $protein-4<0 || $vegetables-3<0){
        $goal = 'N';
    }else{
        $goal = 'Y';
    };

    //新建或更新
    if($storeType=='C'){
      $Post = new Diary;
    }else{
      $id = Input::get('id');
      $Post = Diary::find($id);
    }

    $Post->title        = $title;
    $Post->breakfast    = $breakfast;
    $Post->lunch        = $lunch;
    $Post->other        = $other;
    $Post->dinner       = $dinner;
    $Post->b_grains     = $b_grains;
    $Post->b_dairy      = $b_dairy;
    $Post->b_fruits     = $b_fruits;
    $Post->b_protein    = $b_protein;
    $Post->b_vegetables = $b_vegetables;
    $Post->l_grains     = $l_grains;
    $Post->l_dairy      = $l_dairy;
    $Post->l_fruits     = $l_fruits;
    $Post->l_protein    = $l_protein;
    $Post->l_vegetables = $l_vegetables;
    $Post->d_grains     = $d_grains;
    $Post->d_dairy      = $d_dairy;
    $Post->d_fruits     = $d_fruits;
    $Post->d_protein    = $d_protein;
    $Post->d_vegetables = $d_vegetables;
    $Post->o_grains     = $o_grains;
    $Post->o_dairy      = $o_dairy;
    $Post->o_fruits     = $o_fruits;
    $Post->o_protein    = $o_protein;
    $Post->o_vegetables = $o_vegetables;
    $Post->goal         = $goal;
    $Post->user_id      = $user_id;
    $Post->save();

    return redirect('/diarys');
  }
}
