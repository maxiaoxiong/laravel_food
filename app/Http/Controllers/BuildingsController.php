<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Http\Request;

use App\Http\Requests;

class BuildingsController extends Controller
{
    public function index()
    {
        $buildings = Building::all();
        return view('buildings.index',compact('buildings'));
    }

    public function create()
    {
        return view('buildings.create');
    }

    public function store(Request $request)
    {
        $flag = Building::firstOrCreate(array_merge($request->except('_token')));
        if($flag){
            return redirect()->route('buildings.index');
        }
    }

    public function edit($id)
    {
        $building = Building::find($id);
        return view('buildings.edit',compact('building'));
    }

    public function update($id,Request $request)
    {
        $building = Building::find($id);
        $building->building_name = $request->get('building_name');
        $flag = $building->save();
        if($flag == 1){
            return redirect()->route('buildings.index');
        }
    }

    public function destroy($id)
    {
        $flag = Building::destroy($id);
        if($flag == 1){
            return redirect()->route('buildings.index');
        }
    }

}
