<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateinmueblesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inmuebletipo_id')->unsigned()->default(0);
            $table->string('ident', 8);
            $table->string('nombre', 25);
            $table->string('descripcion', 50);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('inmuebletipo_id')->references('id')->on('inmueble_tipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inmuebles');
    }
}
