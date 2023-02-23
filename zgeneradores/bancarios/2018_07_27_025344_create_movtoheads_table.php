<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatemovtoheadsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movtoheads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inmueble_id')->unsigned()->default(0);
            $table->integer('propertyarea_id')->unsigned()->default(0);
            $table->integer('provider_id')->unsigned()->default(0);
            $table->string('movtype', 1);
            $table->dateTime('fechafactura');
            $table->string('folio', 21);
            $table->string('doc_link', 150);
            $table->decimal('stotal', 19, 4);
            $table->decimal('iva', 19, 4);
            $table->decimal('gtotal', 19, 4);
            $table->string('status', 15);
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
        Schema::drop('movtoheads');
    }
}
