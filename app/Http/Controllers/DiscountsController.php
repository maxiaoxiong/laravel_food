<?php

namespace App\Http\Controllers;

use App\PreferentialDish;
use Illuminate\Http\Request;

use App\Http\Requests;

class DiscountsController extends Controller
{
    public function index()
    {
        $preferentials = PreferentialDish::latest()->get();
        return view('discounts.index',compact('preferentials'));
    }

    public function destroy($id)
    {

    }
}
