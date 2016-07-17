<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/9/16
 * Time: 3:42 PM
 */

namespace App\Api\Transformers;


use App\Window;
use League\Fractal\TransformerAbstract;

class WindowTransformers extends TransformerAbstract
{
    public function transform(Window $window)
    {
        return [
            'id' => $window['id'],
            'name' => $window['name']
        ];
    }
}