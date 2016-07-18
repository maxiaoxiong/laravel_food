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
                'tableware' => [
                    'data' => isset($dish->tablewares[0]) ? $dish->tablewares : [],
                    'limit_num' => isset($dish->tablewares[0]) ? $dish->tablewares[0]->pivot->limit_num : '',
                    'name' => '餐具',
                ],
                'taste' => [
                    'data' => isset($dish->tastes[0]) ? $dish->tastes : [],
                    'limit_num' => isset($dish->tastes[0]) ? $dish->tastes[0]->pivot->limit_num : '',
                    'name' => '口味',
                ],
                'typeone' => [
                    'data' => isset($dish->typeones[0]) ? $dish->typeones : [],
                    'limit_num' => isset($dish->typeones[0]) ? $dish->typeones[0]->pivot->limit_num : '',
                    'name' => '类型一',
                ],
                'typetwo' => [
                    'data' => isset($dish->typetwos[0]) ? $dish->typetwos : [],
                    'limit_num' => isset($dish->typetwos[0]) ? $dish->typetwos[0]->pivot->limit_num : '',
                    'name' => '类型二',
                ],
                'typethree' => [
                    'data' => isset($dish->typethrees[0]) ? $dish->typethrees : [],
                    'limit_num' => isset($dish->typethrees[0]) ? $dish->typethrees[0]->pivot->limit_num : '',
                    'name' => '类型三',
                ],
                'typefour' => [
                    'data' => isset($dish->typefours[0]) ? $dish->typefours : [],
                    'limit_num' => isset($dish->typefours[0]) ? $dish->typefours[0]->pivot->limit_num : '',
                    'name' => '类型四',
                ],
            ]
        ];
    }
}