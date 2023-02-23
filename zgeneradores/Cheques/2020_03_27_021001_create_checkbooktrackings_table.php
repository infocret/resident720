<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatecheckbooktrackingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkbooktrackings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checkissuance_id')->unsigned()->default(0);
            $table->integer('user_id')->unsigned()->default(0);
            $table->date('datereg');
            $table->string('status', 20);
            $table->string('observ', 250);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('checkissuance_id')->references('id')->on('checkissuances');
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
        Schema::drop('checkbooktrackings');
    }
}
