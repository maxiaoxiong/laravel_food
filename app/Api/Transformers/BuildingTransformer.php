<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/13/16
 * Time: 5:27 PM
 */

namespace App\Api\Transformers;


use App\Building;
use League\Fractal\TransformerAbstract;

class BuildingTransformer extends TransformerAbstract
{
    public function transform(Building $building)
    {
        return [
            'id' => $building->id,
            'name' => $building->building_name
        ];
    }
}