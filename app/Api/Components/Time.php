<?php
/**
 * Created by PhpStorm.
 * User: xicode
 * Date: 16-7-20
 * Time: 下午8:12
 */

namespace App\Api\Components;


use Carbon\Carbon;

class Time
{
    public static function getCurrentTimeArr()
    {
        $lastDayTime = Carbon::create(Carbon::yesterday()->year, Carbon::yesterday()->month, Carbon::yesterday()->day,
            '18', '30', '00');
        $todayMorningTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            '07', '00', '00');
        $todayNoonTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            '11', '30', '00');
        $todayAfterTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            '17', '30', '00');
        $timeNow = Carbon::now();

        if ($timeNow >= $lastDayTime && $timeNow <= $todayMorningTime) {
            return [$lastDayTime, $todayMorningTime];
        } elseif ($timeNow >= $todayMorningTime && $timeNow <= $todayNoonTime) {
            return [$todayMorningTime, $todayNoonTime];
        } elseif ($timeNow >= $todayNoonTime && $timeNow <= $todayAfterTime) {
            return [$todayNoonTime, $todayAfterTime];
        }
    }
}