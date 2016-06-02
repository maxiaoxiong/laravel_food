<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'phone' => $faker->randomNumber(9),
        'sex' => 'man',
        'avatar' => $faker->imageUrl(300,300),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Admin::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'phone' => $faker->randomNumber(9),
        'sex' => 'man',
        'avatar' => $faker->imageUrl(300,300),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Canteen::class, function (Faker\Generator $faker) {
    return [
        'canteen_name' => $faker->name,
    ];
});
$factory->define(App\Dishtype::class, function (Faker\Generator $faker) {
    return [
        'dish_type_name' => $faker->name,
    ];
});
$factory->define(App\Building::class, function (Faker\Generator $faker) {
    return [
        'building_name' => $faker->name,
    ];
});
$factory->define(App\Tableware::class, function (Faker\Generator $faker) {
    return [
        'tableware_name' => $faker->name,
    ];
});
$factory->define(App\PreferentialDish::class, function (Faker\Generator $faker) {
    $dish_ids = \App\Dish::lists('id')->toArray();
    return [
        'dish_id' => $faker->randomElement($dish_ids)
    ];
});
$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    $user_ids = \App\User::lists('id')->toArray();
    $dish_ids = \App\Dish::lists('id')->toArray();
    return [
        'body' => $faker->paragraph,
        'user_id' => $faker->randomElement($user_ids),
        'dish_id' => $faker->randomElement($dish_ids)
    ];
});
$factory->define(App\Range::class, function (Faker\Generator $faker) {
    $user_ids = \App\User::lists('id')->toArray();
    $dish_ids = \App\Dish::lists('id')->toArray();
    return [
        'range' => 10*rand(0,1),
        'user_id' => $faker->randomElement($user_ids),
        'dish_id' => $faker->randomElement($dish_ids)
    ];
});
$factory->define(App\TablewareForDish::class, function (Faker\Generator $faker) {
    $tableware_ids = \App\Tableware::lists('id')->toArray();
    $dish_ids = \App\Dish::lists('id')->toArray();
    return [
        'tableware_id' => $faker->randomElement($tableware_ids),
        'dish_id' => $faker->randomElement($dish_ids)
    ];
});

$factory->define(App\Window::class, function (Faker\Generator $faker) {
    $canteen_ids = \App\Canteen::lists('id')->toArray();
    return [
        'window_name' => $faker->name,
        'canteen_id' => $faker->randomElement($canteen_ids)
    ];
});

$factory->define(App\Floor::class, function (Faker\Generator $faker) {
    $building_ids = \App\Building::lists('id')->toArray();
    return [
        'floor_name' => $faker->name,
        'building_id' => $faker->randomElement($building_ids)
    ];
});

$factory->define(App\Dormitory::class, function (Faker\Generator $faker) {
    $floor_ids = \App\Floor::lists('id')->toArray();
    return [
        'name' => $faker->name,
        'floor_id' => $faker->randomElement($floor_ids)
    ];
});

$factory->define(App\Dish::class, function (Faker\Generator $faker) {
    $window_ids = \App\Window::lists('id')->toArray();
    $dishtype_ids = \App\Dishtype::lists('id')->toArray();
    return [
        'dish_name' => $faker->name,
        'dish_price' => $faker->randomFloat(null,1,3),
        'dish_img'  => $faker->imageUrl(320,320),
        'window_id' => $faker->randomElement($window_ids),
        'dishtype_id' => $faker->randomElement($dishtype_ids),
        'delivery_at' => Carbon\Carbon::createFromDate()->toTimeString()
    ];
});


$factory->define(App\Order::class, function (Faker\Generator $faker) {
    $user_ids = \App\User::lists('id')->toArray();
    $dish_ids = \App\Dish::lists('id')->toArray();
    return [
        'billing_id' => $faker->randomNumber(1),
        'subject' => $faker->title,
        'type' => $faker->randomNumber(1),
        'order_no' => $faker->randomNumber(2),
        'user_id' => $faker->randomElement($user_ids),
        'dish_id' => $faker->randomElement($dish_ids)
    ];
});



$factory->define(App\Window::class, function (Faker\Generator $faker) {
    $canteen_ids = \App\Canteen::lists('id')->toArray();
    return [
        'window_name' => $faker->name,
        'canteen_id' => $faker->randomElement($canteen_ids)
    ];
});

$factory->define(App\Taste::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\TasteForDish::class, function (Faker\Generator $faker) {
    $dish_ids = \App\Dish::lists('id')->toArray();
    $taste_ids = \App\Taste::lists('id')->toArray();
    return [
        'dish_id' => $faker->randomElement($dish_ids),
        'taste_id' => $faker->randomElement($taste_ids),
    ];
});
$factory->define(App\TasteForOrder::class, function (Faker\Generator $faker) {
    $order_ids = \App\Order::lists('id')->toArray();
    $taste_ids = \App\Taste::lists('id')->toArray();
    return [
        'order_id' => $faker->randomElement($order_ids),
        'taste_id' => $faker->randomElement($taste_ids),
    ];
});
$factory->define(App\TablewareForOrder::class, function (Faker\Generator $faker) {
    $order_ids = \App\Order::lists('id')->toArray();
    $tableware_ids = \App\Taste::lists('id')->toArray();
    return [
        'order_id' => $faker->randomElement($order_ids),
        'tableware_id' => $faker->randomElement($tableware_ids),
    ];
});

$factory->define(App\Advertise::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'img_url' => $faker->imageUrl(300,200),
        'url' => $faker->url
    ];
});

$factory->define(App\Type::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});

