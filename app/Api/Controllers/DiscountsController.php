<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/12/16
 * Time: 2:47 PM
 */

namespace App\Api\Controllers;


use App\Api\Transformers\DiscountTransformer;
use App\PreferentialDish;

class DiscountsController extends BaseController
{
    public function getDishes()
    {
        $discounts = PreferentialDish::latest()->paginate(8);
        return $this->response->paginator($discounts,new DiscountTransformer())->setStatusCode(200);
    }
}