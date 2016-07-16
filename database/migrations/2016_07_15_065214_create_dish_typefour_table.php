<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishTypefourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_typefour', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dish_id')->unsigned();
            $table->foreign('dish_id')
                ->references('id')
                ->on('dishes')
                ->onDelete('cascade');
            $table->integer('typefour_id')->unsigned();
            $table->foreign('typefour_id')
                ->references('id')
                ->on('typefours')
                ->onDelete('cascade');
            $table->integer('limit_num');
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
        Schema::drop('dish_typefours');
    }
}