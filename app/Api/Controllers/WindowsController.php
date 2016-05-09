<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/9/16
 * Time: 3:45 PM
 */

namespace App\Api\Controllers;


use App\Api\Transformers\WindowTransformers;
use App\Canteen;
use App\Window;

class WindowsController extends BaseController
{
    public function index($id)
    {
        $windows = Canteen::find($id)->windows;
        return $this->response->collection($windows,new WindowTransformers())->setStatusCode(200);
    }
}