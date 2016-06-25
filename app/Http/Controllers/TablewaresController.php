<?php

namespace App\Http\Controllers;

use App\Tableware;
use Illuminate\Http\Request;

use App\Http\Requests;

class TablewaresController extends Controller
{

    public function index()
    {
        $tablewares = Tableware::all();
        return view('tablewares.index',compact('tablewares'));
    }

    public function create()
    {
        return view('tablewares.create');
    }

    public function store(Request $request)
    {
        $flag = Tableware::firstOrCreate(array_merge($request->except('_token')));
        if($flag){
            return redirect()->route('tablewares.index');
        }
    }
    public function edit($id)
    {
        $tableware = Tableware::find($id);
        return view('tablewares.edit',compact('tableware'));
    }

    public function update($id, Request $request)
    {
        $Tableware = Tableware::find($id);
        $Tableware->tableware_name = $request->get('tableware_name');
        $Tableware->price = $request->get('price');
        $flag = $Tableware->save();
        if($flag == 1){
            return redirect()->route('tablewares.index');
        }
    }

    public function destroy($id)
    {
        $flag = Tableware::destroy($id);
        if($flag){
            return redirect()->route('tablewares.index');
        }
    }
}
