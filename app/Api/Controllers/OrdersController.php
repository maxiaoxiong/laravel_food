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
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;

class OrdersController extends BaseController
{
    /**
     * @return mixed
     */
    public function index()
    {
        $orders = Order::all();

        return $this->response->collection($orders, new OrderTransformer())->setStatusCode(200);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        if (!$id) {
            return $this->response->errorNotFound('Order not found');
        }

        return $this->response->item($order, new OrderTransformer())->setStatusCode(200);
    }

    public function store(Request $request)
    {
        $data = $request->get('data');
        foreach ($data as $k => $v) {
            $flag = Order::firstOrCreate(array_merge($data[ $k ]));
            if (!$flag) {
                throw new StoreResourceFailedException('创建订单失败！');
            }
        }

        return response()->json(['status_code'=>200,'message'=>'创建订单成功！']);

    }
}