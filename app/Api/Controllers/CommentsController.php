<?php


namespace App\Api\Controllers;


use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CommentsController extends BaseController
{
    public function store(Request $request)
    {
        $user = \JWTAuth::parseToken()->authenticate();
        $comment_list = $user->orders->lists('dish_id')->toArray();

        if (!in_array($request->get('dish_id'), $comment_list)) {
            throw new AccessDeniedHttpException('您未购买过该菜，没有权限评论！');
        }
        $flag = Comment::create(array_merge($request->all(), ['user_id' => $user->id]));
        if ($flag) {
            return response()->json(['status_code' => 200, 'message' => '评论成功'])->setStatusCode(200);
        } else {
            return response()->json(['status_code' => 422, 'message' => '评论失败'])->setStatusCode(422);
        }
    }
}