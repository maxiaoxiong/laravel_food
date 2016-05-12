<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/12/16
 * Time: 2:59 PM
 */

namespace App\Api\Transformers;


use App\PreferentialDish;
use League\Fractal\TransformerAbstract;

class DiscountTransformer extends TransformerAbstract
{
    public function transform(PreferentialDish $preferentialDish)
    {
        $range_sum = 0;
        $range_length = count($preferentialDish->dish->ranges);
        switch ($range_length){
            case 0:
                $range_length = 1;
                break;
            default:
                for($i=0;$i<$range_length;$i++){
                    $range_sum += $preferentialDish->dish->ranges[$i]->range;
                }
        }

        $average = ceil($range_sum/$range_length);
        return [
            'id' => $preferentialDish->dish->id,
            'name' => $preferentialDish->dish->dish_name,
            'img_url' => $preferentialDish->dish->dish_img,
            'price' => $preferentialDish->dish->dish_price,
            'sales' => $preferentialDish->dish->orders()->sum('order_no'),
            'address' => $preferentialDish->dish->window->canteen->canteen_name.' '.$preferentialDish->dish->window->window_name,
            'delivery_time' => $preferentialDish->dish->delivery_time,
            'range' => $average
        ];
    }
}