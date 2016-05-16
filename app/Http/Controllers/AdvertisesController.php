<?php

namespace App\Http\Controllers;

use App\Advertise;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdvertisesController extends Controller
{
    public function index()
    {
        $advertises = Advertise::all();
        return view('advertises.index',compact('advertises'));
    }

    public function create()
    {
        return view('advertises.create');
    }

    public function store(Request $request)
    {
        $flag = Advertise::firstOrCreate(array_merge($request->except('_token')));
        if($flag){
            return redirect()->route('advertises.index');
        }
    }

    public function edit($id)
    {
        $advertise = Advertise::find($id);
        return view('advertises.edit',compact('advertise'));
    }

    public function update($id,Request $request)
    {
        $advertise = Advertise::find($id);
        $data = array_merge(array_merge($request->except('_token')));
        $flag = $advertise->update($data);
        if($flag){
            return redirect()->route('advertises.index');
        }
    }

    public function destroy($id)
    {
        $flag = Advertise::destroy($id);
        if($flag == 1){
            return redirect()->route('advertises.index');
        }
    }
}
