<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePushTimeliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_timelies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('msg_id');
            $table->string('sendno');
            $table->text('content');
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
        Schema::drop('push_timelies');
    }
}
