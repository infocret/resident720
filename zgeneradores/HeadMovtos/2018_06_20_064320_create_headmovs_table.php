<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateheadmovsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headmovs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inmueble_id')->unsigned()->default(0);
            $table->integer('propertyarea_id')->unsigned()->default(0);
            $table->integer('provider_id')->unsigned()->default(0);
            $table->dateTime('fecharegistro');
            $table->dateTime('fechafactura');
            $table->string('folio', 25);
            $table->string('doc', 100);
            $table->decimal('stotal', 19, 4);
            $table->decimal('iva', 19, 4);
            $table->decimal('gtotal', 19, 4);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('inmueble_id')->references('id')->on('inmuebles');
            $table->foreign('propertyarea_id')->references('id')->on('propertyareas');
            $table->foreign('provider_id')->references('id')->on('providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('headmovs');
    }
}
