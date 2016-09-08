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
        $timeNow = Carbon::now()->createFromTime()->toTimeString();
        $todayMorningTime = \Cache::get('早餐');
        $todayAfterTime = \Cache::get('晚餐');
        $todayNoonTime = \Cache::get('午餐');
        if ($timeNow <= $todayMorningTime || $timeNow >= $todayAfterTime) {
            $discounts = Dish::has('preferentialDish')->where('dishtype_id', 1)->get();
        } elseif ($timeNow >= $todayMorningTime && $timeNow <= $todayNoonTime) {
            $discounts = Dish::has('PreferentialDish')->where('dishtype_id', 2)->orWhere('dishtype_id', 4)->get();
        } elseif ($timeNow >= $todayNoonTime && $timeNow <= $todayAfterTime) {
            $discounts = Dish::has('PreferentialDish')->where('dishtype_id', 3)->orWhere('dishtype_id', 4)->get();
        }
        return $this->response->collection($discounts, new DiscountTransformer())->setStatusCode(200);
    }
}