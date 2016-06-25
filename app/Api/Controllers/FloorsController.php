<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/13/16
 * Time: 5:29 PM
 */

namespace App\Api\Controllers;


use App\Api\Transformers\FloorTransformer;
use App\Building;

class FloorsController extends BaseController
{
    public function getFloors($id)
    {
        $floors = Building::find($id)->floors;
        return $this->response->collection($floors,new FloorTransformer())->setStatusCode(200);
    }
}