<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatedetailmovsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailmovs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('headmov_id')->unsigned()->default(0);
            $table->integer('movimientoTipo_id')->unsigned()->default(0);
            $table->decimal('cantidad', 8, 4);
            $table->string('unidad', 8);
            $table->string('descripcion', 150);
            $table->decimal('preciounit', 19, 4);
            $table->decimal('subtot', 19, 4);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('headmov_id')->references('id')->on('headmovs');
            $table->foreign('movimientoTipo_id')->references('id')->on('movimiento_tipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('detailmovs');
    }
}
