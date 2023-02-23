<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInmuebleTiposTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmueble_tipos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ident', 8);
            $table->string('nombre', 25);
            $table->string('descripcion', 50);
            $table->string('imgfilename', 50);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inmueble_tipos');
    }
}
