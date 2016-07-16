<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/12/16
 * Time: 10:58 PM
 */

namespace App\Api\Transformers;


use App\Dish;
use League\Fractal\TransformerAbstract;

class DishDetailTransformer extends TransformerAbstract
{
    public function transform(Dish $dish)
    {
        $sales = 0;
        for($i=0;$i<count($dish->orders);$i++){
            $sales += $dish->orders[$i]->pivot->num;
        }

        $range_sum = 0;
        $range_length = count($dish->ranges);
        switch ($range_length){
            case 0:
                $range_length = 1;
                break;
            default:
                for($i=0;$i<$range_length;$i++){
                    $range_sum += $dish->ranges[$i]->range;
                }
        }
        $arr = [];
        foreach($dish->comments as $k => $comment)
        {
            $arr[$k] = [
                'user_avatar' => $comment->user->avatar,
                'user_name' => $comment->user->name,
                'body' => $comment->body,
                'created_at' => $comment->created_at
            ];
        }
        $average = ceil($range_sum/$range_length);
        return [
            'id' => $dish['id'],
            'name' => $dish['name'],
            'img_url' => $dish['dish_img'],
            'price' => $dish['price'],
            'sales' => $sales,
            'delivery_time' => $dish['delivery_time'],
            'range' => $average,
            'comments' => $arr,
            'type' => [
                'tablewares' => [
                    'data' => $dish->tablewares,
                    'limit_num' => $dish->tablewares[0]->pivot->limit_num
                ],
                'tastes' => [
                    'data' => $dish->tastes,
                    'limit_num' => $dish->tastes[0]->pivot->limit_num
                ],
                'typeones' => [
                    'data' => $dish->typeones,
                    'limit_num' => $dish->typeones[0]->pivot->limit_num
                ],
                'typetwos' => [
                    'data' => $dish->typetwos,
                    'limit_num' => $dish->typetwos[0]->pivot->limit_num
                ],
                'typethrees' => [
                    'data' => $dish->typethrees,
                    'limit_num' => $dish->typethrees[0]->pivot->limit_num
                ],
                'typefours' => [
                    'data' => $dish->typefours,
                    'limit_num' => $dish->typefours[0]->pivot->limit_num
                ],
            ]
        ];
    }
}