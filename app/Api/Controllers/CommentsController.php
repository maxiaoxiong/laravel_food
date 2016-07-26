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
        foreach ($user->orders as $order) {
            foreach ($order->dishes as $dish) {
                $comment_list[] = $dish->id;
            }
        }
        if (!in_array($request->get('dish_id'), $comment_list)) {
            return response()->json(['status_code' => 403, 'message' => '您未购买过该菜，没有权限评论！']);
        }
        $isComment = Comment::where('user_id', $user->id)->where('dish_id', $request->get('dish_id'))->get();
        if (count($isComment) !== 0) {
            return response()->json(['status_code' => 200, 'message' => '请勿重复评论']);
        }
        $comment = Comment::create(array_merge($request->all(), ['user_id' => $user->id]));
        if ($comment instanceof $comment) {
            return response()->json(['status_code' => 200, 'message' => '评论成功'])->setStatusCode(200);
        } else {
            return response()->json(['status_code' => 422, 'message' => '评论失败'])->setStatusCode(422);
        }
    }
}