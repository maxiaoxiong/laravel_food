<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/12/16
 * Time: 2:59 PM
 */

namespace App\Api\Transformers;


use App\Dish;
use App\PreferentialDish;
use League\Fractal\TransformerAbstract;

class DiscountTransformer extends TransformerAbstract
{
    public function transform(Dish $dish)
    {
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

        $average = ceil($range_sum/$range_length);

        return [
            'id' => $dish->id,
            'name' => $dish->name,
            'img_url' => $dish->dish_img,
            'price' => (string)$dish->price,
            'sales' => (int)$dish->ordered_count,
            'address' => $dish->window->canteen->name.' '.$dish->window->name,
            'delivery_time' => $dish->delivery_time,
            'range' => $average,
            'desc' => '掌柜推荐'
        ];
    }
}