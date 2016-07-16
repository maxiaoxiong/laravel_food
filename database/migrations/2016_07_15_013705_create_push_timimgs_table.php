<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePushTimimgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_timings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('schedule_id');
            $table->string('name');
            $table->text('content');
            $table->string('time');
            $table->enum('status',['success','failed']);
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
        Schema::drop('push_timings');
    }
}
