<?php

namespace App\Http\Controllers;

use App\Typefour;
use Illuminate\Http\Request;

use App\Http\Requests;

class TypefoursController extends Controller
{
    public function index()
    {
        $typefours = Typefour::all();
        return view('typefours.index',compact('typefours'));
    }

    public function create()
    {
        return view('typefours.create');
    }

    public function store(Request $request)
    {
        $flag = Typefour::firstOrCreate(array_merge($request->except('_token')));
        if($flag){
            return redirect()->route('typefours.index');
        }
    }

    public function edit($id)
    {
        $typefour = Typefour::find($id);
        return view('typefours.edit',compact('typefour'));
    }

    public function update($id, Request $request)
    {
        $typefour = Typefour::find($id);
        $typefour->name = $request->get('name');
        $typefour->price = $request->get('price');
        $flag = $typefour->save();
        if($flag == 1){
            return redirect()->route('typefours.index');
        }
    }

    public function destroy($id)
    {
        $flag = Typefour::destroy($id);
        if($flag){
            return redirect()->route('typefours.index');
        }
    }
}
