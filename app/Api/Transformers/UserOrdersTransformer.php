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
        /*
         * 要改
         */
        return [
            'orders' => $order,
            'dishes' => $order->dishes()->get(['dishes.id','name']),

        ];
    }
}