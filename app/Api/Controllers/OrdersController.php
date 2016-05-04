<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/3/16
 * Time: 10:54 PM
 */

namespace App\Api\Controllers;


use App\Api\Transformers\OrderTransformer;
use App\Order;

class OrdersController extends BaseController
{
    public function index()
    {
        $orders = Order::all();
        return $this->collection($orders,new OrderTransformer());
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        if(!$id){
            return $this->response->errorNotFound('Order not found');
        }
        return $this->item($order,new OrderTransformer());
    }
}