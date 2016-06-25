<?php

namespace App\Http\Controllers;

use App\Tableware;
use App\Taste;
use Illuminate\Http\Request;

use App\Http\Requests;

class TastesController extends Controller
{
    public function index()
    {
        $tastes = Taste::all();
        return view('tastes.index',compact('tastes'));
    }

    public function store(Request $request)
    {
        $flag = Taste::firstOrCreate(array_merge($request->except('_token')));
        if($flag){
            return redirect()->route('tastes.index');
        }
    }

    public function update($id,Request $request)
    {
        $taste = Taste::find($id);
        $taste->name = $request->get('name');
        $flag = $taste->save();
        if($flag == 1){
            return redirect()->route('tastes.index');
        }
    }

    public function create()
    {
        return view('tastes.create');
    }

    public function edit($id,Request $request)
    {
        $taste = Taste::find($id);
        return view('tastes.edit',compact('taste'));
    }

    public function destroy($id)
    {
        $flag = Taste::destroy($id);
        if($flag){
            return redirect()->route('tastes.index');
        }
    }
}
