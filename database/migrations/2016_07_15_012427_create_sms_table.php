<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('to');
            $table->string('temp_id');
            $table->string('data');
            $table->string('content');
            $table->string('voice_code');
            $table->mediumInteger('fail_times');
            $table->integer('last_fail_time')->unsigned();
            $table->integer('send_time')->unsigned();
            $table->string('result_info');
            $table->timestamps();
            $table->timestamp('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sms');
    }
}
