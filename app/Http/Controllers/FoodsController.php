<?php

namespace App\Http\Controllers;

use App\Canteen;
use Illuminate\Http\Request;

use App\Http\Requests;

class FoodsController extends Controller
{
    public function index()
    {
        $canteens = Canteen::all();
        return view('foods.index',compact('canteens'));
    }
}
