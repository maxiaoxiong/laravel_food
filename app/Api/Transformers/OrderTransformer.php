<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/3/16
 * Time: 10:58 PM
 */

namespace App\Api\Transformers;


use App\Order;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    public function transform(Order $order)
    {
        return [
            'id' => $order['id'],
            'user_id' => $order['user_id'],
            'dish_id' => $order['dish_id']
        ];
    }
}