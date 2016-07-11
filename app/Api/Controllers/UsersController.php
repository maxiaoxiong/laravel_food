<?php
/**
 * Created by PhpStorm.
 * User: xicode
 * Date: 16-7-11
 * Time: 下午4:10
 */

namespace App\Api\Controllers;


use App\Api\Transformers\UserOrdersTransformer;
use App\Order;

class UsersController extends BaseController
{
    public function show($id)
    {
        $orders = Order::where('user_id',$id)->get();
        return $this->response->collection($orders,new UserOrdersTransformer())->setStatusCode(200);
    }
}