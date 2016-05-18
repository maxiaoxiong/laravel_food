<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/9/16
 * Time: 9:25 AM
 */

namespace App\Api\Controllers;


use App\Api\Transformers\DishDetailTransformer;
use App\Api\Transformers\DishTransformer;
use App\Api\Transformers\HotDishTransformer;
use App\Api\Transformers\WindowDishesTransformer;
use App\Dish;
use App\Order;
use App\Window;
use Carbon\Carbon;

class DishesController extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getHot()
    {
        $orders = Order::groupBy('dish_id')->select('dish_id',\DB::raw('sum(order_no) as order_no'))->get()->take(10);
        return $this->response->collection($orders,new HotDishTransformer())->setStatusCode(200);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getWindowDishes($id)
    {
        $timeNow = Carbon::now()->createFromTime()->toTimeString();
        if($timeNow < "06:30:00"){
            $dishes = Window::find($id)->dishes()->where('dishtype_id',1)->paginate(8);
        }elseif($timeNow > "07:30:00" && $timeNow < "11:30:00"){
            $dishes = Window::find($id)->dishes()->where(function($query){
                $query->where('dishtype_id',2)->orWhere(function($query){
                    $query->where('dishtype_id',4);
                });
            })->paginate(8);
        }elseif($timeNow > "12:30:00" && $timeNow < "17:30:00"){
            $dishes = Window::find($id)->dishes()->where(function($query){
                $query->where('dishtype_id',3)->orWhere(function($query){
                    $query->where('dishtype_id',4);
                });
            })->paginate(8);
        }
        return $this->response->paginator($dishes,new WindowDishesTransformer())->setStatusCode(200);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getBreakfast()
    {
        $dishes = Dish::where('dishtype_id',1)->paginate(8);
        return $this->response->paginator($dishes,new DishTransformer())->setStatusCode(200);
    }

    public function getDetail($id)
    {
        $dish = Dish::find($id);
        return $this->response->item($dish,new DishDetailTransformer())->setStatusCode(200);
    }
}