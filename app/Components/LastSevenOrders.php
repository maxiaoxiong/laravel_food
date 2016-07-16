<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/17/16
 * Time: 12:42 PM
 */

namespace App\Components;


use App\Order;
use Carbon\Carbon;

class LastSevenOrders
{
    static public function getSevenDaysOrders()
    {
        $str = '';
        for($i=6;$i>=0;$i--)
        {
            if($i<6 && $i>0) {
                $str .= (Order::where('created_at', '>=', Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
                        '18', '30', '00')->subDay($i+1))
                    ->where('created_at', '<=', Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
                        '18', '30', '00')->subDay($i))->count()) .',';
            }elseif($i == 0) {
                $str .= (Order::where('created_at', '>=', Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
                        '18', '30', '00')->subDay($i+1))
                        ->where('created_at', '<=', Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
                            '18', '30', '00')->subDay($i))->count()) .']';
            }elseif($i == 6){
                $str .= '['.(Order::where('created_at', '>=', Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
                        '18', '30', '00')->subDay($i+1))
                        ->where('created_at', '<=', Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
                            '18', '30', '00')->subDay($i))->count()) .',';
            }
        }
        return $str;
    }
}