<?php

namespace App\Http\Controllers;

use App\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->paginate(10);
        return view('comments.index',compact('comments'));
    }

    public function destroy($id)
    {
        $flag = Comment::destroy($id);
        return $flag;
    }
}
