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
use Carbon\Carbon;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Redis;

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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->get('data');
        foreach ($data as $k => $v) {
            $order = Order::Create(array_merge($data[ $k ]));
            if (!$order) {
                throw new StoreResourceFailedException('创建订单失败！');
            }
            $order->tastes()->attach($data[ $k ]['taste_id']);
            $order->tablewares()->attach($data[ $k ]['tableware_id']);
        }
        $ordersToday = Order::where('created_at', '>=', Carbon::today())->count();
        $data = [
            'event' => 'ordersToday',
            'data' => [
                'num' => $ordersToday
            ]
        ];
        Redis::publish('test-channel', json_encode($data));

        return response()->json(['status_code' => 200, 'message' => '创建订单成功！']);

    }
}