<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/9/16
 * Time: 9:25 AM
 */

namespace App\Api\Controllers;


use App\Api\Transformers\DishTransformer;
use App\Api\Transformers\HotDishTransformer;
use App\Api\Transformers\WindowDishesTransformer;
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
        $orders = Order::groupBy('dish_id')->orderBy('order_no','desc')->get()->take(10);
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
            return $dishes;
        }elseif($timeNow > "07:30:00" && $timeNow < "11:30:00"){
            $dishes = Window::find($id)->dishes()->where(function($query){
                $query->where('dishtype_id',2)->orWhere(function($query){
                    $query->where('dishtype_id',4);
                });
            })->paginate(8);
//            $dishes = Window::find($id)->dishes()->where('dishtype_id',2)->where('dishtype_id',4)->paginate(8);
        }elseif($timeNow > "12:30:00" && $timeNow < "17:30:00"){
            $dishes = Window::find($id)->dishes()->where(function($query){
                $query->where('dishtype_id',3)->orWhere(function($query){
                    $query->where('dishtype_id',4);
                });
            })->paginate(8);
        }
        return $this->response->paginator($dishes,new WindowDishesTransformer())->setStatusCode(200);
    }
}