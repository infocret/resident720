<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateperioddatesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perioddates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('period_id')->unsigned()->default(0);
            $table->date('date');
            $table->integer('yearday');
            $table->string('action', 60);
            $table->string('status', 15);
            $table->string('observations', 150);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('period_id')->references('id')->on('periods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('perioddates');
    }
}
