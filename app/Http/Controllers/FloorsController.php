<?php

namespace App\Http\Controllers;

use App\Building;
use App\Floor;
use Illuminate\Http\Request;

use App\Http\Requests;

class FloorsController extends Controller
{
    public function index()
    {
        $buildings = Building::all();
        return view('floors.index',compact('buildings'));
    }

    public function create()
    {
        $buildings = Building::all();
        return view('floors.create',compact('buildings'));
    }

    public function store(Request $request)
    {
        $flag = Floor::firstOrCreate(array_merge($request->except('_token')));
        if($flag){
            return redirect()->route('floors.index');
        }
    }

    public function edit($id)
    {
        $buildings = Building::all();
        $floor = Floor::find($id);
        return view('floors.edit',compact('buildings','floor'));
    }

    public function update($id,Request $request)
    {
        $floor = Floor::find($id);
        $floor->floor_name = $request->get('floor_name');
        $floor->building_id = $request->get('building_id');
        $flag = $floor->save();
        if($flag == 1){
            return redirect()->route('floors.index');
        }
    }

    public function destroy($id)
    {
        $flag = Floor::destroy($id);
        if($flag == 1){
            return redirect()->route('floors.index');
        }
    }
}
