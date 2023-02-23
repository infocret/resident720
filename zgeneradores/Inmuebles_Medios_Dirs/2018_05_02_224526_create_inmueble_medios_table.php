<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInmuebleMediosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmueble_medios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medio_id')->unsigned()->default(0);
            $table->integer('inmueble_id')->unsigned()->default(0);
            $table->string('dato', 50);
            $table->string('observaciones', 100);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('medio_id')->references('id')->on('medios');
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
        Schema::drop('inmueble_medios');
    }
}
