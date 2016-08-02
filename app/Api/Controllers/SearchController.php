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
use Cache;
use Carbon\Carbon;
use Searchy;

class SearchController extends BaseController
{
    public function search($keyword)
    {
        $lastDayTime = Carbon::create(Carbon::yesterday()->year, Carbon::yesterday()->month, Carbon::yesterday()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('6'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('6'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('6'))->second);
        $todayMorningTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('2'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('2'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('2'))->second);
        $todayNoonTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('4'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('4'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('4'))->second);
        $todayAfterTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('6'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('6'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('6'))->second);
        $timeNow = Carbon::now();
        if ($timeNow <= $todayMorningTime || $timeNow >= $todayNoonTime) {
            $dishes = Dish::where('dishtype_id', 1)->where('name', 'like', '%' . $keyword . '%')->get();
        } elseif ($timeNow >= $todayMorningTime && $timeNow <= $todayNoonTime) {
            $dishes = Dish::where('dishtype_id', 2)->where('name', 'like', '%' . $keyword . '%')->get();
        } elseif ($timeNow >= $todayNoonTime && $timeNow <= $todayAfterTime) {
            $dishes = Dish::where('dishtype_id', 3)->where('name', 'like', '%' . $keyword . '%')->get();
        }
        return $this->response->collection($dishes, new DishTransformer())->setStatusCode(200);
    }
}