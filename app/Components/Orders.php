<?php
/**
 * Created by PhpStorm.
 * User: xicode
 * Date: 16-7-11
 * Time: 下午8:23
 */

namespace App\Components;


use App\Order;
use Carbon\Carbon;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Redis;

class Orders
{
    static public function store($data)
    {
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
    }
}