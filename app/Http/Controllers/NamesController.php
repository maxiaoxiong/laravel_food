<?php

namespace App\Http\Controllers;

use App\Name;
use Illuminate\Http\Request;

use App\Http\Requests;

class NamesController extends Controller
{
    public function index()
    {
        $names = Name::all();
        return view('names.index', compact('names'));
    }

    public function create()
    {
        return view('names.create');
    }

    public function store(Request $request)
    {
        $flag = Name::firstOrCreate(array_merge($request->except('_token')));
        if ($flag) {
            return redirect()->route('names.index');
        }
    }

    public function edit($id)
    {
        $name = Name::find($id);
        return view('names.edit', compact('name'));
    }

    public function update($id, Request $request)
    {
        $name = Name::find($id);
        $name->name = $request->get('name');
        $flag = $name->save();
        if ($flag == 1) {
            return redirect()->route('names.index');
        }
    }

    public function destroy($id)
    {
        $flag = Name::destroy($id);
        if ($flag == 1) {
            return redirect()->route('names.index');
        }
    }
}
