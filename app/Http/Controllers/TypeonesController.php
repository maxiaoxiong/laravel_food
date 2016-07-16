<?php

namespace App\Http\Controllers;

use App\Typeone;
use Illuminate\Http\Request;

use App\Http\Requests;

class TypeonesController extends Controller
{
    public function index()
    {
        $typeones = Typeone::all();
        return view('typeones.index',compact('typeones'));
    }

    public function create()
    {
        return view('typeones.create');
    }

    public function store(Request $request)
    {
        $flag = Typeone::firstOrCreate(array_merge($request->except('_token')));
        if($flag){
            return redirect()->route('typeones.index');
        }
    }

    public function edit($id)
    {
        $typeone = Typeone::find($id);
        return view('typeones.edit',compact('typeone'));
    }

    public function update($id, Request $request)
    {
        $Typeone = Typeone::find($id);
        $Typeone->name = $request->get('name');
        $Typeone->price = $request->get('price');
        $flag = $Typeone->save();
        if($flag == 1){
            return redirect()->route('typeones.index');
        }
    }

    public function destroy($id)
    {
        $flag = Typeone::destroy($id);
        if($flag){
            return redirect()->route('typeones.index');
        }
    }
}
