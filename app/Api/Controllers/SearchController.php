<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/12/16
 * Time: 11:27 PM
 */

namespace App\Api\Controllers;


use App\Api\Transformers\DishTransformer;
use App\Dish;
use Searchy;

class SearchController extends BaseController
{
    public function search($keyword)
    {
        $dishes = Dish::where('name','like','%'.$keyword.'%')->paginate(8);
        return $this->response->paginator($dishes,new DishTransformer())->setStatusCode(200);
    }
}