<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->integer('monday_dish_id')->unsigned();
            $table->integer('tuesday_dish_id')->unsigned();
            $table->integer('wednesday_dish_id')->unsigned();
            $table->integer('thursday_dish_id')->unsigned();
            $table->integer('friday_dish_id')->unsigned();
            $table->integer('saturday_dish_id')->unsigned();
            $table->integer('sunday_dish_id')->unsigned();
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
        Schema::drop('packages');
    }
}
