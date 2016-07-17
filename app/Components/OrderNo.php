<?php
/**
 * Created by PhpStorm.
 * User: xicode
 * Date: 16-7-16
 * Time: 下午3:51
 */

namespace App\Components;


class OrderNo
{
    static public function getOrderNo()
    {
        return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
}