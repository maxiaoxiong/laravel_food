<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/9/16
 * Time: 3:42 PM
 */

namespace App\Api\Transformers;


use App\Order;
use League\Fractal\TransformerAbstract;

class UserOrdersTransformer extends TransformerAbstract
{
    public function transform(Order $order)
    {
        return [
            'order_no' => $order['order_no'],
            'dish' => [
                'dish_id' => $order['dish_id'],
                'dish_name' => $order->dish->dish_name,
                'dish_price' => $order->dish->dish_price
            ],
            'tablewares' => $order->tablewares()->get(),
            'tastes' => $order->tastes()->get()
        ];
    }
}