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
use App\Dishtype;
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

        $mor = Dishtype::where('name', '早餐')->first();
        $mor_id = $mor->id;
        $non = Dishtype::where('name', '午餐')->first();
        $non_id = $non->id;
        $aft = Dishtype::where('name', '晚餐')->first();
        $aft_id = $aft->id;
        $non_aft = Dishtype::where('name', '午晚餐')->first();
        $non_aft_id = $non_aft->id;

        if ($timeNow <= $todayMorningTime || $timeNow >= $todayAfterTime) {
            $discounts = Dish::has('preferentialDish')->where('dishtype_id', $mor_id)->get();
        } elseif ($timeNow >= $todayMorningTime && $timeNow <= $todayNoonTime) {
            return $discounts = Dish::has('PreferentialDish')->where(function ($query) use ($non_id, $non_aft_id) {
                $query->where('dishtype_id', $non_id)->orWhere(function ($query) use ($non_aft_id) {
                    $query->where('dishtype_id', $non_aft_id);
                });
            })->get();
        } elseif ($timeNow >= $todayNoonTime && $timeNow <= $todayAfterTime) {
            return $discounts = Dish::has('PreferentialDish')->where(function ($query) use ($aft_id, $non_aft_id) {
                $query->where('dishtype_id', $aft_id)->orWhere(function ($query) use ($non_aft_id) {
                    $query->where('dishtype_id', $non_aft_id);
                });
            })->get();
        }
        return $this->response->collection($discounts, new DiscountTransformer())->setStatusCode(200);
    }
}