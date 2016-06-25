<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/16/16
 * Time: 11:59 PM
 */

namespace App\Api\Controllers;


use App\Advertise;
use App\Api\Transformers\AdvertiseTransformer;

class AdvertisesController extends BaseController
{
    public function index()
    {
        $advertises = Advertise::all();
        return $this->response->collection($advertises,new AdvertiseTransformer())->setStatusCode(200);
    }
}