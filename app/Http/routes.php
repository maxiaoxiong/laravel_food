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

use App\Mobile;
use App\Order;
use Carbon\Carbon;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {
        $api->post('user/login', 'AuthController@authenticate');
        $api->post('user/getVerifyCode', 'AuthController@getVerifyCode');
        $api->post('user/validateCode', 'AuthController@validateCode');
        $api->post('user/register', 'AuthController@register');
        $api->post('user/resetPassword', 'AuthController@resetPassword');
        $api->post('user/getResetPasswordCode', 'AuthController@getResetPasswordCode');
        $api->get('canteens', 'CanteensController@index');
        $api->get('dishes/hot', 'DishesController@getHot');
        $api->get('canteens/{id}/windows', 'WindowsController@index');
        $api->get('windows/{id}/dishes', 'DishesController@getWindowDishes');
        $api->get('windows/{window_id}/{type_id}/dishes', 'DishesController@getWindowTypeDishes');
        $api->get('discounts', 'DiscountsController@getDishes');
        $api->get('breakfasts', 'DishesController@getBreakfast');
        $api->get('dishes/{id}', 'DishesController@getDetail');
        $api->get('search/{keyword}', 'SearchController@search');
        $api->get('buildings', 'BuildingsController@index');
        $api->get('buildings/{id}/floors', 'FloorsController@getFloors');
        $api->get('floors/{id}/dormitories', 'DormitoriesController@getDormitories');
        $api->get('advertises', 'AdvertisesController@index');
        $api->post('advices','AdvicesController@store');

        $api->group(['middleware' => 'jwt.auth'], function ($api) {
            $api->post('pay', 'OrdersController@pay');
            $api->get('user/{id}/orders', 'UsersController@show');
            $api->post('orders', 'OrdersController@store');
            $api->get('orders', 'OrdersController@index');

            $api->post('dishes/range', 'DishesController@postRange');
            $api->post('comments', 'CommentsController@store');
            $api->get('orders/{id}', 'OrdersController@show');
            $api->get('user/me', 'AuthController@getAuthenticatedUser');

        });
    });
});

Route::get('/', function () {
    if (Auth::guest()){
        return view('auth.login');
    }else{
        return redirect('/home');
    }
});

Route::get('/s', function () {
    $data = [
        'event' => 'UserSignedUp',
        'data' => [
            'username' => 'xicode'
        ]
    ];
    Redis::publish('test-channel', json_encode($data));

    return view();
});


Route::get('/image', function () {
    $img = Image::canvas(800, 600, '#ff0000');
    $response = response()->make($img->encode('png'));
    $response->header('Content-Type', 'image/png');

    return $response;
});

Route::get('/path', function (\Illuminate\Http\Request $request) {
    return dd($request->all());
});


Route::get('comment', 'CommentsController@index');

/**
 * web route
 */

Route::post('pay/status', 'OrdersController@payStatus');

Route::group(['middleware' => ['web','auth']],function (){
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::resource('home', 'HomeController');

    Route::resource('foods', 'FoodsController');

    Route::resource('canteens', 'CanteensController');

    Route::resource('windows', 'WindowsController');

    Route::resource('dishes', 'DishesController');

    Route::resource('dishware', 'DishwareController');

    Route::resource('buildings', 'BuildingsController');

    Route::resource('floors', 'FloorsController');

    Route::resource('dormitories', 'DormitoriesController');

    Route::resource('users', 'UsersController');

    Route::resource('comments', 'CommentsController');

    Route::resource('discounts', 'DiscountsController');

    Route::resource('dishtypes', 'DishtypesController');

    Route::resource('tastes', 'TastesController');

    Route::resource('tablewares', 'TablewaresController');

    Route::resource('advertises', 'AdvertisesController');

    Route::resource('types', 'TypesController');
    
    Route::resource('typeones','TypeonesController');
    
    Route::resource('typetwos','TypetwosController');
    
    Route::resource('typethrees','TypethreesController');
    
    Route::resource('typefours','TypefoursController');
    
    Route::resource('advices','AdvicesController');

    Route::post('image/upload', 'ImageController@upload');
    Route::post('image/crop', 'ImageController@crop');
    Route::get('getWindows/{id}', function ($id) {
        return \App\Canteen::find($id)->windows;
    });
    Route::get('getFloors/{id}', function ($id) {
        return \App\Building::find($id)->floors;
    });
    Route::get('orders/today', 'OrdersController@getTodayOrders');
    Route::get('orders/week', 'OrdersController@getWeekOrders');
    Route::get('orders/history', 'OrdersController@getHistoryOrders');
    Route::get('orders/month','OrdersController@getMonthOrders');
    Route::get('orders/printOrders/{type}', 'OrdersController@printOrders');

    Route::get('push/history', 'PushController@index');
    Route::get('push/new', 'PushController@add');

    Route::post('push/timely', 'PushController@timely');
    Route::post('push/timing', 'PushController@timing');
    
    Route::get('test', function (){
        $orders =  \App\Floor::find(1)->dormitories[0]->orders()->where('orders.created_at','>=',\Carbon\Carbon::createFromDate()
            ->startOfMonth())->get();
        $dishes = $orders[0]->dishes;
        return $dishes;
    });
});
