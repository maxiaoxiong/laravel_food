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
use App\Type;
use App\Window;

class WindowsController extends BaseController
{
    public function index($id)
    {
        $windows = Canteen::find($id)->windows;
        $types = Type::all();
        return $this->response->collection($windows,new WindowTransformers())->setMeta($types->toArray())->setStatusCode(200);
    }
}