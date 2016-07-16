<?php

namespace App\Http\Controllers;

use App\Typethree;
use Illuminate\Http\Request;

use App\Http\Requests;

class TypethreesController extends Controller
{
    public function index()
    {
        $typethrees = Typethree::all();
        return view('typethrees.index',compact('typethrees'));
    }

    public function create()
    {
        return view('typethrees.create');
    }

    public function store(Request $request)
    {
        $flag = Typethree::firstOrCreate(array_merge($request->except('_token')));
        if($flag){
            return redirect()->route('typethrees.index');
        }
    }

    public function edit($id)
    {
        $typethree = Typethree::find($id);
        return view('typethrees.edit',compact('typethree'));
    }

    public function update($id, Request $request)
    {
        $Typethree = Typethree::find($id);
        $Typethree->name = $request->get('name');
        $Typethree->price = $request->get('price');
        $flag = $Typethree->save();
        if($flag == 1){
            return redirect()->route('typethrees.index');
        }
    }

    public function destroy($id)
    {
        $flag = Typetwo::destroy($id);
        if($flag){
            return redirect()->route('typetwos.index');
        }
    }
}
