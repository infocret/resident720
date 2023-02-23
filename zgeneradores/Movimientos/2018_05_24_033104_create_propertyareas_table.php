<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatepropertyareasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propertyareas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inmueble_id')->unsigned()->default(0);
            $table->string('nombre', 15);
            $table->string('descripcion', 40);
            $table->string('planta', 10);
            $table->string('filename', 50);
            $table->string('filepath', 150);
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
        Schema::drop('propertyareas');
    }
}
