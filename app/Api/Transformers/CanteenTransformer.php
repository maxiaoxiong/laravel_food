<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/9/16
 * Time: 8:58 AM
 */

namespace App\Api\Transformers;


use App\Canteen;
use League\Fractal\TransformerAbstract;

class CanteenTransformer extends TransformerAbstract
{
    public function transform(Canteen $canteen)
    {
        return [
            'id' => $canteen['id'],
            'name' => $canteen['name'],
            'img_url' => $canteen['img']
        ];
    }
}