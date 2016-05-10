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

class DishesController extends BaseController
{
    public function getHot()
    {
        $orders = Order::groupBy('dish_id')->orderBy('order_no','desc')->get()->take(10);
        return $this->response->collection($orders,new HotDishTransformer())->setStatusCode(200);
    }
    public function getWindowDishes($id)
    {
        $dishes = Window::find($id)->dishes()->paginate(8);
        return $this->response->paginator($dishes,new WindowDishesTransformer())->setStatusCode(200);
    }
}