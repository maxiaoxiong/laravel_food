<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/9/16
 * Time: 8:57 AM
 */

namespace App\Api\Controllers;


use App\Api\Transformers\CanteenTransformer;
use App\Canteen;

class CanteensController extends BaseController
{
    public function index()
    {
        $canteens = Canteen::all();
        return $this->response->collection($canteens,new CanteenTransformer())->setStatusCode(200);
    }
}