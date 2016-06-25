<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DishwareController extends Controller
{
    public function index()
    {
        return view('dishware.index');
    }

    public function create()
    {
        return view('dishware.create');
    }

    public function edit($id)
    {
        return view('dishware.edit');
    }
}
