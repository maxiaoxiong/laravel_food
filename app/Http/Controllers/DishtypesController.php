<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Dishtype;
use Illuminate\Http\Request;

use App\Http\Requests;

/**
 * Class DishtypesController
 * @package App\Http\Controllers
 */
class DishtypesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $dishtypes = Dishtype::all();
        return view('dishtypes.index',compact('dishtypes'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('dishtypes.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $flag = Dishtype::firstOrCreate(array_merge($request->except('_token')));
        if($flag){
            return redirect()->route('dishtypes.index');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $dishtype = Dishtype::find($id);
        return view('dishtypes.edit',compact('dishtype'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $dishtype = Dishtype::find($id);
        $dishtype->dish_type_name = $request->get('dish_type_name');
        $flag = $dishtype->save();
        if($flag == 1){
            return redirect()->route('dishtypes.index');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $flag = Dishtype::destroy($id);
        if($flag){
            return redirect()->route('dishtypes.index');
        }
    }
}
