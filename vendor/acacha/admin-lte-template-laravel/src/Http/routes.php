<?php
/*
 * Same configuration as Laravel 5.2 make auth:
 * See https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/routes.stub
 * but take into account we have to add 'web' middleware group here because Laravel by defaults add this middleware in
 * RouteServiceProvider
 */
Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::resource('home', 'HomeController');

    Route::resource('foods','FoodsController');

    Route::resource('canteens','CanteensController');

    Route::resource('windows','WindowsController');

    Route::resource('dishes','DishesController');

    Route::resource('dishware','DishwareController');

    Route::resource('buildings','BuildingsController');

    Route::resource('floors','FloorsController');

    Route::resource('dormitories','DormitoriesController');

    Route::resource('users','UsersController');

    Route::resource('comments','CommentsController');

    Route::resource('discounts','DiscountsController');

    Route::resource('dishtypes','DishtypesController');

    Route::resource('tastes','TastesController');

    Route::resource('tablewares','TablewaresController');

    Route::resource('advertises','AdvertisesController');

    Route::post('image/upload','ImageController@upload');
    Route::post('image/crop','ImageController@crop');
    Route::get('getWindows/{id}',function($id){
        return \App\Canteen::find($id)->windows;
    });
    Route::get('getFloors/{id}',function($id){
        return \App\Building::find($id)->floors;
    });
    Route::get('orders/today','OrdersController@getTodayOrders');
    Route::get('orders/week','OrdersController@getWeekOrders');
    Route::get('orders/history','OrdersController@getHistoryOrders');
    Route::get('orders/printOrders/{type}','OrdersController@printOrders');

});
