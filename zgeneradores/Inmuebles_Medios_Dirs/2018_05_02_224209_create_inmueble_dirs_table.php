<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInmuebleDirsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmueble_dirs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inmueble_id')->unsigned()->default(0);
            $table->integer('location_id')->unsigned()->default(0);
            $table->integer('codpo_id')->unsigned()->default(0);
            $table->string('pais', 40);
            $table->string('calle', 150);
            $table->string('numExt', 8);
            $table->string('piso', 8);
            $table->string('numInt', 8);
            $table->string('referencia1', 100);
            $table->string('referencia2', 100);
            $table->string('linkmapa', 300);
            $table->string('imagenMapa', 150);
            $table->string('observaciones', 150);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('inmueble_id')->references('id')->on('inmuebles');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('codpo_id')->references('id')->on('cod_pos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inmueble_dirs');
    }
}
