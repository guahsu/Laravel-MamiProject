<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Input;
use App\User;
use App\Calendar_note;
use App\Calendar_event;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{

    //孕期日曆首頁
    public function index()
    {
        /*判斷是否已登入，取得登入者的經期資料；否則預設為今日&週期28天*/
        if(Auth::check()){
            $get_user = User::where('id', '=', Auth::id())->first();
            $mcDate   = $get_user->mc_date;
            $mcCycle  = $get_user->mc_cycle;
        }else{
            $mcDate = date('Y-m-d');
            $mcCycle = '28';
        }

        //預設日曆時間為今日
        $year   = date('Y');
        $month  = date('m');
        $day    = date('d');

        //預產期
        $dueDate  = $this->dueDate($mcDate, $mcCycle);

        //產生日曆
        $calendar = $this->calendar($dueDate, $year, $month, $day);

        //週數事件
        $calendarNote = $this->calendarNote($mcDate, $dueDate, $year, $month, $day);

        //自訂事件
        $calendarEvent = $this->calendarEvent($year, $month, $day);

        //回傳資料到view
        return view('calendar/index', compact('calendar', 'calendarNote', 'calendarEvent'));

    }

    //孕期日曆動作
    public function action()
    {
        /* $action = 傳入動作 */
        $action  = Input::get('action');  //= 傳入動作(參閱上方)
        /*
        ** (0)setEvent:新增事件屬性設定
        ** (1)changeMcDate:重設經期資訊，重置事件日為今天
        ** (2)week-event:依據點擊年月日及最後經期日推算事件日
        ** (3)goToday:切換到執行日的月份
        ** (4)prev:切換為上個月
        ** (5)next:切換為下個月
        */

        /*
        **前端傳入屬性取得
        */
        $mcDate     = Input::get('mcDate');     //= 最後經期日
        $mcCycle    = Input::get('mcCycle');    //= 經期週期
        $year       = Input::get('year');       //= 點選的年份
        $month      = Input::get('month');      //= 點選的月份
        $day        = Input::get('day');        //= 點選的日期
        $eventType  = Input::get('eventType');  //= 事件類別 C:新增 U:更新
        $eventId    = Input::get('eventId');    //= 事件ID
        $eventDate  = Input::get('eventDate');  //= 事件日期
        $eventTitle = Input::get('eventTitle'); //= 事件標題
        $eventPhone = Input::get('eventPhone'); //= 事件備註1(電話)
        $eventAddr  = Input::get('eventAddr');  //= 事件備註2(地址)
        $eventNote  = Input::get('eventNote');  //= 事件備註3(內容)

        /*
        **setEvent
        **透過setEvent新增/編輯自訂事件
        **若存檔成功則回傳結果值帶到View中
        */
        if($action == 'setEvent'){

            $response = $this->setEvent($eventType, $eventId, $eventDate, $eventTitle, $eventPhone, $eventAddr, $eventNote);

            return $response;
        }

        /*
        **dueDate
        **透過calendarDueDate計算預產日期
        */
        $dueDate = $this->dueDate($mcDate, $mcCycle);

        /*
        **changeMcDate-update
        **若重設資訊，檢查是否已登入，若有登入則更新使用者資訊。
        */
        if($action == 'changeMcDate'){
            if(Auth::check()){
                $user_id  = Auth::id();
                $get_user = User::find($user_id);
                $get_user->mc_date  = $mcDate;
                $get_user->mc_cycle = $mcCycle;
                $get_user->save();
            }
            $year   = date('Y');
            $month  = date('m');
            $day    = date('d');
        }

        /*
        ** (1)changeMcDate & (2)week-event
        ** 透過calendarNote取得當前週數對應事件
        ** 透過calendarEvent取得當前對應自訂事件
        */
        if($action == 'week-event' || $action == 'changeMcDate'){
            $response  = $this->calendarNote($mcDate, $dueDate, $year, $month, $day);
            $response += $this->calendarEvent($year, $month, $day);
            return $response;
        }

        /*
        **(3)goToday
        **透過calendarNote & calendarCreate取得當前日曆與對應事件
        */
        if($action == 'goToday'){
            $year   = date('Y');
            $month  = date('m');
            $day    = date('d');
            $response  = $this->calendarNote($mcDate, $dueDate, $year, $month, $day);
            $response += $this->calendar($dueDate, $year, $month, $day);
            return $response;
        }

        /*
        **(4)prev & (5)next
        **透過月份加減傳入calendarCreate取得對應日曆
        */
        if($action == 'prev'){
            $month = $month - 1;
        }
        if($action == 'next'){
            $month = $month + 1;
        }
        //產生日曆
        $response = $this->calendar($dueDate, $year, $month, $day);

        return $response;
    }

    /*************************************************************************************************/
    //新增&編輯日曆事件
    public function setEvent($eventType, $eventId, $eventDate, $eventTitle, $eventPhone, $eventAddr, $eventNote){
        //新建或更新
        if($eventType=='C'){
          $Post = new Calendar_event;
        }else{
          $Post = Calendar_event::find($eventId);
        }
        //
        $Post->user_id        = Auth::id();
        $Post->event_date     = date('Y-m-d', strtotime($eventDate));
        $Post->event_title    = $eventTitle;
        $Post->event_content1 = $eventPhone;
        $Post->event_content2 = $eventAddr;
        $Post->event_content3 = $eventNote;
        $Post->save();
        //回傳值設定
        $calendarEvent['event-set']   = 'Y';
        $calendarEvent['event-id']    = $eventId;
        $calendarEvent['event-title'] = e($eventTitle);
        $calendarEvent['event-phone'] = e($eventPhone);
        $calendarEvent['event-addr']  = e($eventAddr);
        $calendarEvent['event-note']  = e($eventNote);

        return $calendarEvent;
    }


    //孕期日曆
    public function calendar($dueDate, $year, $month, $day){
        //格式化
        $rows = 1;
        $date = mktime(12, 0, 0, $month, 1, $year);
        $daysInMonth = date('t', $date);
        $weekday     = date('w', $date);

        //回傳資料
        $calendar['dataYear']     = date('Y', $date); //= 資料年
        $calendar['displayYear']  = date('Y', $date); //= 顯示年
        $calendar['dataMonth']    = date('m', $date); //= 資料月(雙數)
        $calendar['displayMonth'] = date('F', $date); //= 顯示月(英文)
        $calendar['days']         = '';               //= 顯示日
        $calendar['dueDate']      = '預產日 : ' . $dueDate; //= 預產期

        //日曆內容組合(月初空白日期格)
        for($i = 1; $i < $weekday; $i++) {
            $calendar['days'] .= '<li><span class="emptyday"></span></li> ';
        }

        //日曆內容組合(本月日期格)
        for($day = 1; $day <= $daysInMonth; $day++) {

            //日補0避免計算日期出錯
            $dateday = str_pad($day,2,'0',STR_PAD_LEFT);

            //若為當日則加上CSS
            if($day == date('d') && $month == date('m') && $year == date('Y')){
                $calendar['days'] .= '<li data-action="week-event" data-day="' . $dateday . '">
                                          <a href="#" onclick="return false">
                                              <span class="today">' . $dateday . '</span>
                                          </a>
                                      </li> ';
            }else{
                $calendar['days'] .= '<li data-action="week-event" data-day="' . $dateday . '">
                                          <a href="#" onclick="return false">
                                              <span class="day">' . $dateday . '</span>
                                          </a>
                                      </li> ';
            }
        }

        //回傳資料
        return $calendar;

    }

    //取得自訂事件
    public function calendarEvent($year, $month, $day){

        $user_id   = Auth::id();
        $eventDate = date('Y-m-d', strtotime($year . $month . $day));
        $result    = Calendar_event::where('user_id',    '=', $user_id)
                                   ->where('event_date', '=', $eventDate)
                                   ->first();
        //
        if ($result==null){
            $calendarEvent['event-set']   = 'N';
            $calendarEvent['event-id']    = '';
            $calendarEvent['event-title'] = '';
            $calendarEvent['event-phone'] = '';
            $calendarEvent['event-addr']  = '';
            $calendarEvent['event-note']  = '';
        }else{
            $calendarEvent['event-set']   = 'Y';
            $calendarEvent['event-id']    = $result->id;
            $calendarEvent['event-title'] = e($result->event_title);
            $calendarEvent['event-phone'] = e($result->event_content1);
            $calendarEvent['event-addr']  = e($result->event_content2);
            $calendarEvent['event-note']  = e($result->event_content3);
        }

        return $calendarEvent;
      }

    //取得週期事件
    public function calendarNote($mcDate, $dueDate, $year, $month, $day){

        //目前週數計算
        $datetime1 = strtotime($mcDate);
        $datetime2 = strtotime($year . $month . $day);
        $secs = $datetime2 - $datetime1;
        $days = ceil($secs / 86400);
        $week = ceil($days / 7);

        //當前週算為第1週
        if( $week == '0' ){
            $week = '1';
        }

        //取得當週紀錄
        if($week >= 0  && $week <= 40){
            $result  = Calendar_note::where('week', '=', $week)->first();
            $calendarNote['week'] = '[第' . $result->week .'週]';
            $calendarNote['date'] = $year . '-' . $month . '-' . $day;
            $calendarNote['content1'] = $result->content1;
            $calendarNote['content2'] = $result->content2;
            $calendarNote['content3'] = $result->content3;
            $calendarNote['content4'] = $result->content4;
        }else{
            $calendarNote['week'] = '[本日非孕期]';
            $calendarNote['date'] = $year . '-' . $month . '-' . $day;
            $calendarNote['content1'] = '';
            $calendarNote['content2'] = '';
            $calendarNote['content3'] = '';
            $calendarNote['content4'] = '';
        }

        //預產日
        $calendarNote['dueDate'] = '預產日 : ' . $dueDate;

        //回傳週期事件
        return $calendarNote;
    }

    //預產期
    public function DueDate($mcDate, $mcCycle){
        /*月經週天數轉秒數*/
        if($mcCycle == 28){
            $mcCycleToSec = 0;
        }else{
            $mcCycleToSec = ($mcCycle - 28) * 86400;
        }
        /*預產期計算(最後經期日+280天+-週期天)*/
        $dueDate = date('Y-m-d', strtotime($mcDate) + 24192000 + $mcCycleToSec);
        //回傳預產期
        return $dueDate;
    }
}
