<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/13/16
 * Time: 5:59 PM
 */

namespace App\Api\Controllers;


use App\Api\Transformers\DormitoryTransformer;
use App\Floor;

class DormitoriesController extends BaseController
{
    public function getDormitories($id)
    {
        $dormitories = Floor::find($id)->dormitories;
        return $this->response->collection($dormitories,new DormitoryTransformer())->setStatusCode(200);
    }
}