<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToOrderDish extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_dish', function (Blueprint $table) {
            $table->string('taste');
            $table->string('tableware');
            $table->string('typeone');
            $table->string('typetwo');
            $table->string('typethree');
            $table->string('typefour');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_dish', function (Blueprint $table) {
            //
        });
    }
}
