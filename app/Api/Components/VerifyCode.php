<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/5/16
 * Time: 8:41 PM
 */

namespace App\Api\Components;

class VerifyCode{
    /**
     * @param int $length
     * @return int
     */
    static function generate_code($length = 6) {
        return rand(pow(10,($length-1)), pow(10,$length)-1);
    }
}