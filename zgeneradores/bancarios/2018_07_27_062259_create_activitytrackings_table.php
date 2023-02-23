<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateactivitytrackingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activitytrackings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movtobankaccount_id')->unsigned()->default(0);
            $table->integer('movtohead_id')->unsigned()->default(0);
            $table->integer('checkbook_id')->unsigned()->default(0);
            $table->integer('bankaccount_id')->unsigned()->default(0);
            $table->integer('user_id')->unsigned()->default(0);
            $table->string('act_type', 15);
            $table->dateTime('activity_date');
            $table->string('status_applied', 15);
            $table->string('observations', 150);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('movtobankaccount_id')->references('id')->on('movtobankaccounts');
            $table->foreign('movtohead_id')->references('id')->on('movtoheads');
            $table->foreign('checkbook_id')->references('id')->on('checkbooks');
            $table->foreign('bankaccount_id')->references('id')->on('bankaccounts');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activitytrackings');
    }
}
