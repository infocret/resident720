<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatepropertyvaluesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propertyvalues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inmueble_id')->unsigned()->default(0);
            $table->decimal('area', 19, 4);
            $table->decimal('porcentaje', 19, 4);
            $table->decimal('valor', 19, 4);
            $table->decimal('presupuesto', 19, 4);
            $table->decimal('cuota', 19, 4);
            $table->decimal('indiv1', 19, 4);
            $table->decimal('indiv2', 19, 4);
            $table->decimal('indiv3', 19, 4);
            $table->decimal('indiv4', 19, 4);
            $table->decimal('indiv5', 19, 4);
            $table->string('param1', 150);
            $table->string('param2', 150);
            $table->string('param3', 150);
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
        Schema::drop('propertyvalues');
    }
}
