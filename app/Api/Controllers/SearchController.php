<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/12/16
 * Time: 11:27 PM
 */

namespace App\Api\Controllers;


use App\Api\Transformers\DishTransformer;
use App\Dish;
use App\Dishtype;
use Cache;
use Carbon\Carbon;
use Searchy;

class SearchController extends BaseController
{
    public function search($keyword)
    {
        $lastDayTime = Carbon::create(Carbon::yesterday()->year, Carbon::yesterday()->month, Carbon::yesterday()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->second);
        $todayMorningTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('早餐'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('早餐'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('早餐'))->second);
        $todayNoonTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('午餐'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('午餐'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('午餐'))->second);
        $todayAfterTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->second);
        $timeNow = Carbon::now();

        $mor = Dishtype::where('name', '早餐')->first();
        $mor_id = $mor->id;
        $non = Dishtype::where('name', '午餐')->first();
        $non_id = $non->id;
        $aft = Dishtype::where('name', '晚餐')->first();
        $aft_id = $aft->id;
        $non_aft = Dishtype::where('name', '午晚餐')->first();
        $non_aft_id = $non_aft->id;
        
        if ($timeNow <= $todayMorningTime || $timeNow >= $todayAfterTime) {
            $dishes = Dish::where('dishtype_id', $mor_id)->where('name', 'like', '%' . $keyword . '%')->get();
        } elseif ($timeNow >= $todayMorningTime && $timeNow <= $todayNoonTime) {
            $dishes = Dish::where('dishtype_id', $non_id)->orWhere('dishtype_id',$non_aft_id)->where('name', 'like', '%' . $keyword . '%')->get();
        } elseif ($timeNow >= $todayNoonTime && $timeNow <= $todayAfterTime) {
            $dishes = Dish::where('dishtype_id', $aft_id)->orWhere('dishtype_id',$non_aft_id)->where('name', 'like', '%' . $keyword . '%')->get();
        }
        return $this->response->collection($dishes, new DishTransformer())->setStatusCode(200);
    }
}