<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/13/16
 * Time: 5:24 PM
 */

namespace App\Api\Controllers;


use App\Api\Transformers\BuildingTransformer;
use App\Building;

class BuildingsController extends BaseController
{
    public function index()
    {
        $buildings = Building::all();
        return $this->response->collection($buildings,new BuildingTransformer())->setStatusCode(200);
    }
}