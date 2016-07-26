<?php

namespace App\Http\Controllers;

use App\Typetwo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Jleon\LaravelPnotify\Notify;

class TypetwosController extends Controller
{
    public function index()
    {
        $typetwos = Typetwo::all();
        return view('typetwos.index',compact('typetwos'));
    }

    public function create()
    {
        return view('typetwos.create');
    }

    public function store(Request $request)
    {
        $flag = Typetwo::firstOrCreate(array_merge($request->except('_token')));
        if($flag){
            return redirect()->route('typetwos.index');
        }
    }

    public function edit($id)
    {
        $typeone = Typetwo::find($id);
        return view('typetwos.edit',compact('typeone'));
    }

    public function update($id, Request $request)
    {
        $Typetwo = Typetwo::find($id);
        $Typetwo->name = $request->get('name');
        $Typetwo->price = $request->get('price');
        $flag = $Typetwo->save();
        if($flag == 1){
            return redirect()->route('typetwos.index');
        }
    }

    public function destroy($id)
    {
        $flag = Typetwo::destroy($id);
        if($flag){
            Notify::success('删除成功！');
            return redirect()->route('typetwos.index');
        }
    }
}
