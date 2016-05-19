<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {
        $api->post('user/login', 'AuthController@authenticate');
        $api->post('user/getVerifyCode', 'AuthController@getVerifyCode');
        $api->post('user/validateCode', 'AuthController@validateCode');
        $api->post('user/register', 'AuthController@register');
        $api->get('canteens', 'CanteensController@index');
        $api->get('dishes/hot', 'DishesController@getHot');
        $api->get('canteens/{id}/windows', 'WindowsController@index');
        $api->get('windows/{id}/dishes', 'DishesController@getWindowDishes');
        $api->get('discounts', 'DiscountsController@getDishes');
        $api->get('breakfasts', 'DishesController@getBreakfast');
        $api->get('dishes/{id}', 'DishesController@getDetail');
        $api->get('search/{keyword}', 'SearchController@search');
        $api->get('buildings', 'BuildingsController@index');
        $api->get('buildings/{id}/floors', 'FloorsController@getFloors');
        $api->get('floors/{id}/dormitories', 'DormitoriesController@getDormitories');
        $api->get('advertises', 'AdvertisesController@index');
        $api->post('orders', 'OrdersController@store');
        $api->group(['middleware' => 'jwt.auth'], function ($api) {
            $api->post('comments','CommentsController@store');
            $api->get('orders', 'OrdersController@index');
            $api->get('orders/{id}', 'OrdersController@show');
            $api->get('user/me', 'AuthController@getAuthenticatedUser');
        });
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/s', function () {
    $data = [
        'event' => 'UserSignedUp',
        'data' => [
            'username' => 'xicode'
        ]
    ];
    Redis::publish('test-channel',json_encode($data));

    return view();
});


Route::get('/charge/pay', 'OrdersController@handleOrder');
Route::get('/charge/paid', 'OrdersController@OverOrder');

Route::get('/image', function () {
    $img = Image::canvas(800, 600, '#ff0000');
    $response = response()->make($img->encode('png'));
    $response->header('Content-Type', 'image/png');

    return $response;
});

Route::get('/path', function (\Illuminate\Http\Request $request) {
    return dd($request->all());
});
//
//Route::group(['prefix'=>'image'],function(){
//    Route::get('view',function(){
//       return view('test.image');
//    });
//    Route::post('upload',function(\Illuminate\Http\Request $request){
////        return $request->file('pic');
//        if($request->hasFile('pic')){
////            return 'success';
//            Image::make($request->file('pic'))->resize(300,200)->save('uploads/foo.jpg');
////            $request->hasFile('pic')->save('uploads/');
//        }else{
//            return "failed";
//        }
//    });
//});

Route::get('time', function () {
//    return \Carbon\Carbon::now()->startOfDay()->subDay(6);
    return \App\Order::where('created_at', '>=', \Carbon\Carbon::now()->startOfDay()->subDay(6))->count();
//      return \Carbon\Carbon::now()->subDay(0)->day;
//    return \Carbon\Carbon::now()->day;
//    $order = \App\Order::find(2)->dormitory->name;
//    return $order;
//    if(Carbon\Carbon::now()->createFromTime()->toTimeString() > "07:00:00"){
//        return "1";
//    }
//    return \App\Dish::find(1)->window->canteen->windows;
//    return \App\Order::find(1)->tastes;
//    return \Carbon\Carbon::createFromDate()->startOfWeek();
//    return \App\Order::find(1)->created_at->today();
//    echo \Carbon\Carbon::createFromDate()->isWeekday();
//    echo \App\Order::find(1)->created_at->isYesterday();
//    return \Carbon\Carbon::createFromDate()->toDateString();
});
Route::get('comment', 'CommentsController@index');