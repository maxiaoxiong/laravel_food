<?php
/*
 * Same configuration as Laravel 5.2:
 * See https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/routes.stub
 */
Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::resource('home', 'HomeController');

    Route::resource('foods','FoodsController');

    Route::resource('canteens','CanteensController');

    Route::resource('windows','WindowsController');

    Route::resource('dishes','DishesController');

    Route::resource('dishware','DishwareController');

    Route::resource('address','AddressController');

    Route::resource('floors','FloorsController');

    Route::resource('dormitories','DormitoriesController');

    Route::resource('users','UsersController');

    Route::resource('comments','CommentsController');

    Route::resource('discounts','DiscountsController');

    Route::resource('dishtypes','DishtypesController');

    Route::resource('tastes','TastesController');

    Route::resource('tablewares','TablewaresController');

    Route::post('image/upload','ImageController@upload');
    Route::post('image/crop','ImageController@crop');
    Route::get('getWindows/{id}',function($id){
        return \App\Canteen::find($id)->windows;
    });
    Route::get('orders/today','OrdersController@getTodayOrders');
    Route::get('orders/week','OrdersController@getWeekOrders');
    Route::get('orders/history','OrdersController@getHistoryOrders');

    Route::get('/', function () {
        return view('welcome');
    });
});
