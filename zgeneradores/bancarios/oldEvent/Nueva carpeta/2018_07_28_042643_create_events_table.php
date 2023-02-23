<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateeventsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ticket_id')->unsigned()->default(0);
            $table->integer('movtohead_id')->unsigned()->default(0);
            $table->string('title', 15);
            $table->string('location', 20);
            $table->string('category', 15);
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->time('time_start');
            $table->time('time_end');
            $table->string('remember', 15);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('ticket_id')->references('id')->on('tickets');
            $table->foreign('movtohead_id')->references('id')->on('movtoheads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
