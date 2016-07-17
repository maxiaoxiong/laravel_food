<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/13/16
 * Time: 5:33 PM
 */

namespace App\Api\Transformers;


use App\Floor;
use League\Fractal\TransformerAbstract;

class FloorTransformer extends TransformerAbstract
{
    public function transform(Floor $floor)
    {
        return [
            'id'=> $floor->id,
            'name' => $floor->name
        ];
    }
}