<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatepropertyparametersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propertyparameters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inmueble_id')->unsigned()->default(0);
            $table->string('parametro', 15);
            $table->string('valor', 50);
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
        Schema::drop('propertyparameters');
    }
}
