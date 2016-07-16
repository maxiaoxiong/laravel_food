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
            $table->string('name');
            $table->double('price')->default(0);
            $table->string('dish_img');
            $table->string('delivery_time');
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
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->onDelete('cascade');
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
