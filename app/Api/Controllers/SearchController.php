<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/12/16
 * Time: 11:27 PM
 */

namespace App\Api\Controllers;


use App\Api\Transformers\DishTransformer;
use Searchy;

class SearchController extends BaseController
{
    public function search($keyword)
    {
        $dishes = Searchy::dishes('dish_name')->query($keyword)->getQuery();
        return $this->response->item($dishes,new DishTransformer())->setStatusCode(200);
        return $dishes;
    }
}