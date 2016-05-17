<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/17/16
 * Time: 11:15 AM
 */

namespace App\Components;


use Carbon\Carbon;

class LastSevenDay
{
    static public function getDaysArr()
    {
        $str = '';
        for($i=6;$i>=0;$i--)
        {
            if($i<6 && $i>0){
                $str .= ((string) Carbon::now()->subDay($i)->day) .',';
            }elseif($i == 0){
                $str .= ((string) Carbon::now()->subDay($i)->day) .']';
            }elseif($i == 6){
                $str .= '['.((string) Carbon::now()->subDay($i)->day) .',';
            }
        }
        return $str;
    }
}