<?php

namespace App\Http\Controllers;

use App\Canteen;
use App\Dish;
use App\Dishtype;
use App\PreferentialDish;
use App\Tableware;
use App\Taste;
use Illuminate\Http\Request;

use App\Http\Requests;

class DishesController extends Controller
{
    public function index()
    {
        $dishes = Dish::latest()->paginate(10);
        return view('dishes.index',compact('dishes'));
    }

    public function create()
    {
        $canteens = Canteen::all();
        $tablewares = Tableware::all();
        $tastes = Taste::all();
        $dishtypes = Dishtype::all();
        return view('dishes.create',compact('tastes','canteens','tablewares','dishtypes'));
    }

    public function store(Request $request)
    {
        $taste_list = $request->get('taste');
        $tableware_list = $request->get('tableware');
        $dish = Dish::create(array_merge($request->except('_token')));
        if($dish){
            $dish->tastes()->attach($taste_list);
            $dish->tablewares()->attach($tableware_list);
            return redirect()->route('dishes.index');
        }else{
            return response()->json(['error'=>'添加失败']);
        }
//        $dish
    }

    public function update($id,Request $request)
    {
//        return $request->all();
        if($request->get('dish_id') == 1)
        {
            $id = $request->get('id');
            $dish = Dish::findOrFail($id);
            $data = $request->except('_token','id');
            $flag = PreferentialDish::firstOrCreate(['dish_id' => $id]);
        }elseif($request->get('dish_id') == 2){
            $id = $request->get('id');
            $dish = Dish::findOrFail($request->get('dishId'));
            $data = $request->except('_token','id');
            $flag = PreferentialDish::destroy($id);
            $dish->update($data);
            return redirect()->route('discounts.index');
        }else{
            $dish = Dish::findOrFail($id);
            $data = $request->except('_token');
            $taste_list = $request->get('taste');
            $tableware_list = $request->get('tableware');
            $dish->tastes()->sync($taste_list);
            $dish->tablewares()->sync($tableware_list);
        }
        $dish->update($data);
        return redirect()->route('dishes.index');
    }

    public function edit($id)
    {
        $canteens = Canteen::all();
        $tablewares = Tableware::all();
        $tastes = Taste::all();
        $dishtypes = Dishtype::all();
        $dish = Dish::find($id);
        $taste_ids = $dish->tastes;
        for($i=0;$i<count($taste_ids);$i++){
            $taste_id_arr[$i]=$taste_ids[$i]->id;
        }
        $tableware_ids = $dish->tablewares;
        for($i=0;$i<count($tableware_ids);$i++){
            $tableware_id_arr[$i]=$tableware_ids[$i]->id;
        }
        return view('dishes.edit',compact('canteens','dish','tablewares','tastes','dishtypes','taste_id_arr','tableware_id_arr'));
    }

    public function destroy($id)
    {
        $flag = Dish::destroy($id);
        if($flag == 1){
            return redirect()->route('dishtypes.index');
        }
    }
}
