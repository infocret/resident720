<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatepresupuestosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inmueble_id')->unsigned()->default(0);
            $table->integer('movtipo_id')->unsigned()->default(0);
            $table->decimal('monto', 8, 4);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('inmueble_id')->references('id')->on('inmuebles');
            $table->foreign('movtipo_id')->references('id')->on('movimiento_tipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('presupuestos');
    }
}
