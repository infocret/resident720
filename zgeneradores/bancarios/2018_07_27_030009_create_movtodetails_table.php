<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatemovtodetailsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movtodetails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movtohead_id')->unsigned()->default(0);
            $table->integer('movimientotipo_id')->unsigned()->default(0);
            $table->integer('cantidad');
            $table->string('unidad', 5);
            $table->string('descripcion', 150);
            $table->decimal('preciounit', 19, 4);
            $table->decimal('subtot', 19, 4);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('movtohead_id')->references('id')->on('movtoheads');
            $table->foreign('movimientotipo_id')->references('id')->on('movimiento_tipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('movtodetails');
    }
}
