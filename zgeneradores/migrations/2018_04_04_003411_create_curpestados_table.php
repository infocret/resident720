<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatecurpestadosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curpestados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estado', 25);
            $table->string('renapo', 2);
            $table->string('abrev', 10);
            $table->string('dosdig', 8);
            $table->string('iso', 10);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('curpestados');
    }
}
