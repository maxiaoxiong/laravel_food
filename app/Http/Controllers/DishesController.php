<?php

namespace App\Http\Controllers;

use App\Canteen;
use App\Dish;
use App\Dishtype;
use App\PreferentialDish;
use App\Tableware;
use App\Taste;
use App\Type;
use Illuminate\Http\Request;

use App\Http\Requests;

class DishesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $dishes = Dish::latest()->paginate(10);

        return view('dishes.index', compact('dishes'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $canteens = Canteen::all();
        $tablewares = Tableware::all();
        $tastes = Taste::all();
        $dishtypes = Dishtype::all();
        $types = Type::all();

        return view('dishes.create', compact('types', 'tastes', 'canteens', 'tablewares', 'dishtypes'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $taste_list = $request->get('taste');
        $tableware_list = $request->get('tableware');
        $dish = Dish::create(array_merge($request->except('_token')));
        if ($dish) {
            $dish->tastes()->attach($taste_list);
            $dish->tablewares()->attach($tableware_list);

            return redirect()->route('dishes.index');
        } else {
            return response()->json(['error' => '添加失败']);
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        if ($request->get('type') == 'addToDiscount') {
            $this->addToDisCount($request);
        } elseif ($request->get('type') == 'removeFromDiscount') {
            $this->removeFromDiscount($request);
            return redirect()->route('discounts.index');
        } else {
            $this->updateAll($id,$request);
        }
        return redirect()->route('dishes.index');
    }

    /**
     * @param $request
     */
    public function addToDisCount($request)
    {
        $id = $request->get('id');
        $dish = Dish::findOrFail($id);
        $data = $request->except('_token', 'id');
        PreferentialDish::firstOrCreate(['dish_id' => $id]);
        $dish->update($data);
    }

    /**
     * @param $request
     */
    public function removeFromDiscount($request)
    {
        $id = $request->get('id');
        $dish = Dish::findOrFail($request->get('dish_id'));
        $data = $request->except('_token', 'id');
        PreferentialDish::destroy($id);
        $dish->update($data);
    }

    /**
     * @param $id
     * @param $request
     */
    public function updateAll($id, $request)
    {
        $dish = Dish::findOrFail($id);
        $data = $request->except('_token');
        $taste_list = $request->get('taste');
        $tableware_list = $request->get('tableware');
        $dish->tastes()->sync($taste_list);
        $dish->tablewares()->sync($tableware_list);
        $dish->update($data);
    }
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $canteens = Canteen::all();
        $tablewares = Tableware::all();
        $tastes = Taste::all();
        $dishtypes = Dishtype::all();
        $dish = Dish::find($id);
        $types = Type::all();

        $taste_ids = $dish->tastes;
        for ($i = 0; $i < count($taste_ids); $i ++) {
            $taste_id_arr[ $i ] = $taste_ids[ $i ]->id;
        }
        $tableware_ids = $dish->tablewares;
        for ($i = 0; $i < count($tableware_ids); $i ++) {
            $tableware_id_arr[ $i ] = $tableware_ids[ $i ]->id;
        }

        return view('dishes.edit', compact('canteens', 'dish', 'tablewares', 'tastes', 'dishtypes', 'taste_id_arr', 'tableware_id_arr', 'types'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $flag = Dish::destroy($id);
        if ($flag == 1) {
            return redirect()->route('dishtypes.index');
        }
    }
}
