<?php

namespace App\Http\Controllers;

use App\Canteen;
use Illuminate\Http\Request;

use App\Http\Requests;

class CanteensController extends Controller
{
    public function index()
    {
        $canteens = Canteen::all();
        return view('canteens.index',compact('canteens'));
    }

    public function create()
    {
        return view('canteens.create');
    }

    public function store(Request $request)
    {
        $flag = Canteen::firstOrCreate(array_merge($request->except('_token')));
        if($flag){
            return redirect()->route('canteens.index');
        }
    }

    public function edit($id)
    {
        $canteen = Canteen::find($id);
        return view('canteens.edit',compact('canteen'));
    }

    public function update($id,Request $request)
    {
        $canteen = Canteen::find($id);
        $canteen->canteen_name = $request->get('canteen_name');
        $flag = $canteen->save();
        if($flag == 1){
            return redirect()->route('canteens.index');
        }
    }

    public function destroy($id)
    {
        $flag = Canteen::destroy($id);
        if($flag == 1){
            return redirect()->route('canteens.index');
        }
    }
}
