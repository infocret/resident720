<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatemaillistsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maillists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inmueble_id')->unsigned()->default(0);
            $table->string('listtype', 8);
            $table->string('email', 60);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('inmueble_id')->references('id')->on('inmuebles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('maillists');
    }
}
