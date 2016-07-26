<?php

namespace App\Http\Controllers;

use App\Canteen;
use App\Window;
use Illuminate\Http\Request;

use App\Http\Requests;
use Jleon\LaravelPnotify\Notify;

class WindowsController extends Controller
{
    public function index()
    {
        $windows = Window::all();
        return view('windows.index',compact('windows'));
    }

    public function create()
    {
        $canteens = Canteen::all();
        return view('windows.create',compact('canteens'));
    }

    public function store(Request $request)
    {
        $flag = Window::firstOrCreate(array_merge($request->except('_token')));
        if($flag){
            return redirect()->route('windows.index');
        }
    }

    public function edit($id)
    {
        $canteens = Canteen::all();
        $window = Window::find($id);
        return view('windows.edit',compact('window','canteens'));
    }

    public function update($id,Request $request)
    {
        $data = $request->except('_token');
        $window = Window::findOrFail($id);
        $flag = $window->update($data);
        if($flag){
            return redirect()->route('windows.index');
        }

    }

    public function destroy($id)
    {
        $flag = Window::destroy($id);
        if ($flag == 1) {
            Notify::success('删除成功');
            return redirect()->route('windows.index');
        }
    }
}
