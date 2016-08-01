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
use App\Api\Transformers\TimeTransformer;
use App\Time;

class TimesController extends BaseController
{
    public function index()
    {
        $times = Time::all();
        return $this->response->collection($times,new TimeTransformer())->setStatusCode(200);
    }
}