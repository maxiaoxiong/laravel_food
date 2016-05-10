<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dish_name');
            $table->float('dish_price');
            $table->string('dish_img');
            $table->integer('window_id')->unsigned();
            $table->foreign('window_id')
                ->references('id')
                ->on('windows')
                ->onDelete('cascade');
            $table->integer('dishtype_id')->unsigned();
            $table->foreign('dishtype_id')
                ->references('id')
                ->on('dishtypes')
                ->onDelete('cascade');
            $table->string('delivery_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dishes');
    }
}
