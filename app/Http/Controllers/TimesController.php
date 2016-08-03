<?php

namespace App\Http\Controllers;

use App\Time;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class TimesController extends Controller
{
    public function index()
    {
        $times = Time::all();
        return view('times.index', compact('times'));
    }

    public function create()
    {
        return view('times.create');
    }

    public function store(Request $request)
    {
        $time = Time::firstOrCreate(array_merge($request->except('_token')));
        if ($time instanceof Time) {
            \Cache::rememberForever($time->name, function () use ($time) {
                return $time->over_time;
            });
            return redirect()->route('times.index');
        }
    }

    public function edit($id)
    {
        $time = Time::find($id);
        return view('times.edit', compact('time'));
    }

    public function update($id, Request $request)
    {
        $time = Time::find($id);
        $time->name = $request->get('name');
        $time->over_time = $request->get('over_time');
        $time->time = $request->get('time');
        $flag = $time->save();
        if ($flag == 1) {
            \Cache::rememberForever($time->name, function () use ($time) {
                return $time->over_time;
            });
            return redirect()->route('times.index');
        }
    }

    public function destroy($id)
    {
        $flag = Time::destroy($id);
        if ($flag == 1) {
            return redirect()->route('times.index');
        }
    }
}
