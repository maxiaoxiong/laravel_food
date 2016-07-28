<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/12/16
 * Time: 2:47 PM
 */

namespace App\Api\Controllers;


use App\Api\Transformers\DiscountTransformer;
use App\Dish;
use App\PreferentialDish;
use Carbon\Carbon;

class DiscountsController extends BaseController
{
    public function getDishes()
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

        if ($timeNow <= $todayMorningTime || $timeNow >= $todayAfterTime) {
            $discounts = Dish::has('preferentialDish')->where('dishtype_id',1)->get();
        } elseif ($timeNow >= $todayMorningTime && $timeNow <= $todayNoonTime) {
            $discounts = Dish::has('PreferentialDish')->where('dishtype_id',2)->get();
        } elseif ($timeNow >= $todayNoonTime && $timeNow <= $todayAfterTime) {
            $discounts = Dish::has('PreferentialDish')->where('dishtype_id',3)->get();
        }
        return $this->response->collection($discounts,new DiscountTransformer())->setStatusCode(200);
    }
}