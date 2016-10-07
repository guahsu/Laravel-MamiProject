<?php

//DEMO
Route::get('/DEMO', 'Auth\AuthController@getLogin');

//測試
Route::get('/forTest', 'SitesController@test');

/*--------------------------------------------------------------------------
| 登入前
|-------------------------------------------------------------------------*/
  //登入頁面
  Route::get('/login', 'Auth\AuthController@getLogin');
  //登入頁動作-登入
  Route::post('/login', 'Auth\AuthController@postLogin');
  //登入頁動作-登出
  Route::get('/logout', 'Auth\AuthController@getLogout');
  //註冊頁面
  Route::get('/register', 'Auth\AuthController@getRegister');
  //註冊頁動作-送出
  Route::post('/register', 'Auth\AuthController@postRegister');
  //忘記密碼頁
  Route::get('/forget', 'Auth\PasswordController@getEmail');
  //忘記密碼頁動作-送出
  Route::post('/forget', 'Auth\PasswordController@postEmail');
  //重置密碼頁
  Route::get('/forget/reset/{token}', 'Auth\PasswordController@getReset');
  //重置密碼頁動作-送出
  Route::post('/forget/reset', 'Auth\PasswordController@postReset');


/*※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※*/
/*----------------------------------------------------------------------------
| 登入後 ※需檢查登入才能使用的頁面※
|---------------------------------------------------------------------------*/
Route::group(['middleware' => 'auth'], function () {

  /*--------------------------------------------------------------------------
  | INDEX首頁
  |-------------------------------------------------------------------------*/
    Route::get('/', function() {
                return Redirect::to('/calendar');
            });
  /*--------------------------------------------------------------------------
  | CALENDAR 孕期日曆
  |-------------------------------------------------------------------------*/
    //TEST
    Route::get('/calendar/test', 'CalendarController@calendar');
    //孕期日曆-列表
    Route::get('/calendar', 'CalendarController@index');
    //孕期日曆-動作(切換上下月、點擊日)
    Route::post('/calendar/action', 'CalendarController@action');
  /*--------------------------------------------------------------------------
  | DIARY 飲食紀錄
  |-------------------------------------------------------------------------*/
    //飲食紀錄-列表
    Route::get('/diarys', 'DiarysController@index');
    //飲食紀錄-查詢
    Route::post('/diarys/search', 'DiarysController@search');
    //飲食紀錄-新增
    Route::get('/diarys/create', 'DiarysController@create');
    //飲食紀錄-存檔
    Route::post('/diarys/store', 'DiarysController@store');

});
/*※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※*/