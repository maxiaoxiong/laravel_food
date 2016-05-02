<?php

namespace App\Http\Controllers;

use App\Building;
use App\Dormitory;
use Illuminate\Http\Request;

use App\Http\Requests;

class DormitoriesController extends Controller
{
    public function index()
    {
        $buildings = Building::all();
        return view('dormitories.index',compact('buildings'));
    }

    public function create()
    {
        $buildings = Building::all();
        return view('dormitories.create',compact('buildings'));
    }

    public function store(Request $request)
    {
        $dormitory = Dormitory::create($request->except('_token'));
        if($dormitory){
            return redirect()->route('dormitories.index');
        }
    }
    public function edit($id)
    {
        $buildings = Building::all();
        $dormitory = Dormitory::findOrFail($id);
        return view('dormitories.edit',compact('buildings','dormitory'));
    }

    public function update($id,Request $request)
    {
        $dormitory = Dormitory::findOrFail($id);
        $data = $request->except('_token');
        $dormitory->update($data);
        return redirect()->route('dormitories.index');
    }

    public function destroy($id)
    {
        $dormitory = Dormitory::destroy($id);
        if($dormitory){
            return redirect()->route('dormitories.index');
        }
    }
}
