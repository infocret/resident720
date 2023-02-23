<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonaInmueblesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_inmuebles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id')->unsigned()->default(0);
            $table->integer('inmueble_id')->unsigned()->default(0);
            $table->integer('reltipo_id')->unsigned()->default(0);
            $table->dateTime('asignacion');
            $table->dateTime('baja');
            $table->string('observaciones', 100);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('inmueble_id')->references('id')->on('inmuebles');
            $table->foreign('reltipo_id')->references('id')->on('persona_inmueble_reltipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('persona_inmuebles');
    }
}
