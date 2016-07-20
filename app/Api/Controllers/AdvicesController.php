<?php
/**
 * Created by PhpStorm.
 * User: xicode
 * Date: 16-7-20
 * Time: 下午10:24
 */

namespace App\Api\Controllers;


use App\Advice;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AdvicesController extends BaseController
{
    public function store(Request $request)
    {
//        $user = \JWTAuth::parseToken()->authenticate();
//        $advice_count = $user->advices->count();

//        if ($advice_count >3){
//            throw new AccessDeniedHttpException('每个人反馈数量为三次，给您带来的不便之处，请您见谅！！');
//        }

        $flag = Advice::create(array_merge($request->all()));
        if ($flag) {
            return response()->json(['status_code' => 200, 'message' => '反馈成功'])->setStatusCode(200);
        } else {
            return response()->json(['status_code' => 422, 'message' => '反馈失败'])->setStatusCode(422);
        }
    }
}