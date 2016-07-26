<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::where('id','>',1)->paginate(10);
        return view('users.index',compact('users'));
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        
    }
}
