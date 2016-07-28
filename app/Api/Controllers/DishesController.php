<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/9/16
 * Time: 9:25 AM
 */

namespace App\Api\Controllers;


use App\Api\Components\Time;
use App\Api\Transformers\DishDetailTransformer;
use App\Api\Transformers\DishTransformer;
use App\Api\Transformers\HotDishTransformer;
use App\Api\Transformers\WindowDishesTransformer;
use App\Dish;
use App\Order;
use App\Range;
use App\Window;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTAuth;

class DishesController extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getHot()
    {
        $todayMorningTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            '07', '00', '00');
        $todayNoonTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            '11', '30', '00');
        $todayAfterTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            '17', '30', '00');
        $timeNow = Carbon::now();

        if ($timeNow <= $todayMorningTime || $timeNow >= $todayAfterTime) {
            $dishes = Dish::where('dishtype_id', 1)->orderBy('ordered_count', 'desc')->get();
        } elseif ($timeNow >= $todayMorningTime && $timeNow <= $todayNoonTime) {
            $dishes = Dish::where('dishtype_id', 2)->orderBy('ordered_count', 'desc')->get();
        } elseif ($timeNow >= $todayNoonTime && $timeNow <= $todayAfterTime) {
            $dishes = Dish::where('dishtype_id', 3)->orderBy('ordered_count', 'desc')->get();
        }
        return $this->response->collection($dishes, new HotDishTransformer())->setStatusCode(200);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getWindowDishes($id)
    {
        $timeNow = Carbon::now()->createFromTime()->toTimeString();
        if ($timeNow < "06:30:00" || $timeNow > "17:30:00") {
            $dishes = Window::find($id)->dishes()->where('dishtype_id', 1)->get();
        } elseif ($timeNow > "06:30:00" && $timeNow < "11:30:00") {
            $dishes = Window::find($id)->dishes()->where(function ($query) {
                $query->where('dishtype_id', 2)->orWhere(function ($query) {
                    $query->where('dishtype_id', 4);
                });
            })->get();
        } elseif ($timeNow > "11:30:00" && $timeNow < "17:30:00") {
            $dishes = Window::find($id)->dishes()->where(function ($query) {
                $query->where('dishtype_id', 3)->orWhere(function ($query) {
                    $query->where('dishtype_id', 4);
                });
            })->get();
        }

        return $this->response->collection($dishes, new WindowDishesTransformer())->setStatusCode(200);
    }


    /**
     * @param $window_id
     * @param $type_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getWindowTypeDishes($window_id, $type_id)
    {
        $timeNow = Carbon::now()->createFromTime()->toTimeString();
        if ($timeNow < "06:30:00" || $timeNow > "17:30:00") {
            $dishes = Window::find($window_id)->dishes()->where('dishtype_id', 1)->where('type_id', $type_id)->get();
        } elseif ($timeNow > "06:30:00" && $timeNow < "11:30:00") {
            $dishes = Window::find($window_id)->dishes()->where(function ($query) {
                $query->where('dishtype_id', 2)->orWhere(function ($query) {
                    $query->where('dishtype_id', 4);
                });
            })->where('type_id', $type_id)->get();
        } elseif ($timeNow > "11:30:00" && $timeNow < "17:30:00") {
            $dishes = Window::find($window_id)->dishes()->where(function ($query) {
                $query->where('dishtype_id', 3)->orWhere(function ($query) {
                    $query->where('dishtype_id', 4);
                });
            })->where('type_id', $type_id)->get();
        }

        return $this->response->collection($dishes, new WindowDishesTransformer())->setStatusCode(200);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getBreakfast()
    {
        $dishes = Dish::where('dishtype_id', 1)->get();

        return $this->response->collection($dishes, new DishTransformer())->setStatusCode(200);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getDetail($id)
    {
        $dish = Dish::find($id);

        return $this->response->item($dish, new DishDetailTransformer())->setStatusCode(200);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws AccessDeniedHttpException
     */
    public function postRange(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        foreach ($user->orders as $order) {
            foreach ($order->dishes as $dish) {
                $range_list[] = $dish->id;
            }
        }
        if (!in_array($request->get('dish_id'), $range_list)) {
            return response()->json(['status_code' => 403, 'message' => '您未购买过该菜，没有权限评分！']);
        }
        $isRange = Range::where('user_id', $user->id)->where('dish_id', $request->get('dish_id'))->get();
        if (count($isRange) !== 0) {
            return response()->json(['status_code' => 200, 'message' => '请勿重复评分']);
        }
        if (count($isRange) == 0){
            $range = Range::create(array_merge($request->except('token'), ['user_id' => $user->id]));
            if ($range instanceof Range) {
                return response()->json(['status_code' => 200, 'message' => '评分成功'])->setStatusCode(200);
            } else {
                return response()->json(['status_code' => 422, 'message' => '评分失败'])->setStatusCode(422);
            }
        }
    }
}