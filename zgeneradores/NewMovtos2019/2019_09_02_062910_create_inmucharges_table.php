<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateinmuchargesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmucharges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inmu_id')->unsigned()->default(0);
            $table->integer('conceptserv_id')->unsigned()->default(0);
            $table->integer('proparea_id')->unsigned()->default(0);
            $table->integer('provider_id')->unsigned()->default(0);
            $table->dateTime('date');
            $table->string('folio', 35);
            $table->decimal('stotal', 19, 4);
            $table->decimal('iva', 19, 4);
            $table->decimal('balance', 19, 4);
            $table->string('status', 15);
            $table->string('description', 150);
            $table->string('observ', 250);
            $table->string('filelink', 250);
            $table->timestamp('deleted_at');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('inmu_id')->references('id')->on('inmuebles');
            $table->foreign('conceptserv_id')->references('id')->on('conceptservices');
            $table->foreign('proparea_id')->references('id')->on('propertyareas');
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
        Schema::drop('inmucharges');
    }
}
