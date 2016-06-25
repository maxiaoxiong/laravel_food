<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/9/16
 * Time: 1:10 PM
 */

namespace App\Api\Transformers;


use App\Order;
use League\Fractal\TransformerAbstract;

class HotDishTransformer extends TransformerAbstract
{
    public function transform(Order $order)
    {
        $range_sum = 0;
        $range_length = count($order->dish->ranges);
        switch ($range_length) {
            case 0:
                $range_length = 1;
                break;
            default:
                for ($i = 0; $i < $range_length; $i ++) {
                    $range_sum += $order->dish->ranges[ $i ]->range;
                }
        }

        $average = ceil($range_sum / $range_length);

        return [
            'id' => $order->dish->id,
            'name' => $order->dish->dish_name,
            'img_url' => $order->dish->dish_img,
            'price' => $order->dish->dish_price,
            'sales' => (int) ($order['order_no']),
            'address' => $order->dish->window->canteen->canteen_name . ' ' . $order->dish->window->window_name,
            'delivery_time' => $order->dish->delivery_time,
            'range' => $average
        ];
    }
}