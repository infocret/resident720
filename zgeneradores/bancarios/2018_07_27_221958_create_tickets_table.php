<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateticketsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inmueble_id')->unsigned()->default(0);
            $table->integer('propertyarea_id')->unsigned()->default(0);
            $table->string('folio', 15);
            $table->string('description', 150);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('inmueble_id')->references('id')->on('inmuebles');
            $table->foreign('propertyarea_id')->references('id')->on('propertyareas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tickets');
    }
}
