<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCodPosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cod_pos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cp', 5);
            $table->string('ciudad', 30);
            $table->string('estado', 60);
            $table->string('municipio', 30);
            $table->string('tipo', 30);
            $table->string('asentamiento', 30);
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
        Schema::drop('cod_pos');
    }
}
