<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/13/16
 * Time: 6:10 PM
 */

namespace App\Api\Transformers;


use App\Dormitory;
use League\Fractal\TransformerAbstract;

class DormitoryTransformer extends TransformerAbstract
{
    public function transform(Dormitory $dormitory)
    {
        return [
            'id' => $dormitory->id,
            'name' => $dormitory->name
        ];
    }
}