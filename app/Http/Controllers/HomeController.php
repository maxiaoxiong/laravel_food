<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Comment;
use App\Components\LastSevenDay;
use App\Http\Requests;
use App\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $ordersToday = Order::where('created_at','>=',Carbon::today())->count();
        $ordersHistory = Order::count();
        $users = User::count();
        $comments = Comment::count();
//        $dayArr = LastSevenDay::getDaysArr();
        return view('home',compact('ordersToday','ordersHistory','users','comments'));
    }
}