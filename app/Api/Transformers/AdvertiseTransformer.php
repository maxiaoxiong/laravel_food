<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/17/16
 * Time: 12:01 AM
 */

namespace App\Api\Transformers;


use App\Advertise;
use League\Fractal\TransformerAbstract;

class AdvertiseTransformer extends TransformerAbstract
{
    public function transform(Advertise $advertise)
    {
        return [
            'id' => $advertise['id'],
            'name' => $advertise['name'],
            'img_url' => $advertise['img_url'],
            'url' => $advertise['url']
        ];
    }
}