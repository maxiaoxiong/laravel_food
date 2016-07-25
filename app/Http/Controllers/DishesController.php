<?php

namespace App\Http\Controllers;

use App\Canteen;
use App\Dish;
use App\Dishtype;
use App\PreferentialDish;
use App\Tableware;
use App\Taste;
use App\Type;
use App\Typefour;
use App\Typeone;
use App\Typethree;
use App\Typetwo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Jleon\LaravelPnotify\Notify;

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
        $typeones = Typeone::all();
        $typetwos = Typetwo::all();
        $typethrees = Typethree::all();
        $typefours = Typefour::all();
        return view('dishes.create', compact('types', 'tastes', 'canteens', 'tablewares', 'dishtypes'
            , 'typeones', 'typetwos', 'typethrees', 'typefours'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'canteen_id' => 'required',
            'window_id' => 'required',
            'name' => 'required',
            'dishtype_id' => 'required',
            'type_id' => 'required',
            'price' => 'required',
            'dish_img' => 'required'
        ]);
        if ($validator->fails()){
            Notify::error($validator->errors()->all());
            return back();
        }
        $taste_list = $request->get('taste');
        $tableware_list = $request->get('tableware');
        $typeone_list = $request->get('typeone');
        $typetwo_list = $request->get('typetwo');
        $typethree_list = $request->get('typethree');
        $typefour_list = $request->get('typefour');
        $dish = Dish::create(array_merge($request->except('_token')));

        if ($dish instanceof Dish) {

            $dish->tastes()->attach($taste_list, ['limit_num' => $request->get('taste_limit_num')]);
            $dish->tablewares()->attach($tableware_list, ['limit_num' => $request->get('tableware_limit_num')]);
            $dish->typeones()->attach($typeone_list, ['limit_num' => $request->get('typeone_limit_num')]);
            $dish->typetwos()->attach($typetwo_list, ['limit_num' => $request->get('typetwo_limit_num')]);
            $dish->typethrees()->attach($typethree_list, ['limit_num' => $request->get('typethree_limit_num')]);
            $dish->typefours()->attach($typefour_list, ['limit_num' => $request->get('typefour_limit_num')]);
            
            Notify::success('创建成功！');
            
            return redirect()->route('dishes.index');
        } else {
            Notify::danger('添加菜色失败');
            return back();
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
            $flag = $this->addToDisCount($request);
            if (!$flag){
                Notify::error('更新失败');
                return back();
            }
        } elseif ($request->get('type') == 'removeFromDiscount') {
            $this->removeFromDiscount($request);
            Notify::success('移除优惠菜色成功！');
            return redirect()->route('discounts.index');
        } else {
            $this->updateAll($id, $request);
        }
        Notify::success('更新成功！');
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
        $preferential_dish = PreferentialDish::firstOrCreate(['dish_id' => $id]);
        if ($preferential_dish instanceof  PreferentialDish){
            $dish->update($data);
            return true;
        }
        return false;
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
        $dish->update($data);
        $taste_list = $request->get('taste');
        $tableware_list = $request->get('tableware');
        $typeone_list = $request->get('typeone');
        $typetwo_list = $request->get('typetwo');
        $typethree_list = $request->get('typethree');
        $typefour_list = $request->get('typefour');
        $dish->tastes()->detach();
        $dish->tastes()->attach($taste_list,['limit_num'=>$request->get('taste_limit_num')]);
        $dish->tablewares()->detach();
        $dish->tablewares()->attach($tableware_list,['limit_num'=>$request->get('tableware_limit_num')]);
        $dish->typeones()->detach();
        $dish->typeones()->attach($typeone_list,['limit_num'=>$request->get('typeone_limit_num')]);
        $dish->typetwos()->detach();
        $dish->typetwos()->attach($typetwo_list,['limit_num'=>$request->get('typetwo_limit_num')]);
        $dish->typethrees()->detach();
        $dish->typethrees()->attach($typethree_list,['limit_num'=>$request->get('typethree_limit_num')]);
        $dish->typefours()->detach();
        $dish->typefours()->attach($typefour_list,['limit_num'=>$request->get('typefour_limit_num')]);
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

        $typeones = Typeone::all();
        $typetwos = Typetwo::all();
        $typethrees = Typethree::all();
        $typefours = Typefour::all();


        $taste_ids = $dish->tastes;
        for ($i = 0; $i < count($taste_ids); $i++) {
            $taste_id_arr[$i] = $taste_ids[$i]->id;
        }
        $tableware_ids = $dish->tablewares;
        for ($i = 0; $i < count($tableware_ids); $i++) {
            $tableware_id_arr[$i] = $tableware_ids[$i]->id;
        }
        $typeone_ids = $dish->typeones;
        for ($i = 0; $i < count($typeone_ids); $i++) {
            $typeone_id_arr[$i] = $typeone_ids[$i]->id;
        }
        $typetwo_ids = $dish->typetwos;
        for ($i = 0; $i < count($typetwo_ids); $i++) {
            $typetwo_id_arr[$i] = $typetwo_ids[$i]->id;
        }
        $typethree_ids = $dish->typethrees;
        for ($i = 0; $i < count($typethree_ids); $i++) {
            $typethree_id_arr[$i] = $typethree_ids[$i]->id;
        }
        $typefour_ids = $dish->typefours;
        for ($i = 0; $i < count($typefour_ids); $i++) {
            $typefour_id_arr[$i] = $typefour_ids[$i]->id;
        }

        return view('dishes.edit', compact('canteens', 'dish', 'tablewares', 'tastes', 'dishtypes',
            'taste_id_arr', 'tableware_id_arr', 'types', 'typeone_id_arr', 'typetwo_id_arr', 'typethree_id_arr'
            , 'typefour_id_arr', 'typeones', 'typetwos', 'typethrees', 'typefours'));
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
