<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/17/16
 * Time: 12:01 AM
 */

namespace App\Api\Transformers;


use App\Advertise;
use App\Time;
use League\Fractal\TransformerAbstract;

class TimeTransformer extends TransformerAbstract
{
    public function transform(Time $time)
    {
        return [
            'id' => $time['id'],
            'name' => $time['name'],
            'time' => $time['time'],
        ];
    }
}