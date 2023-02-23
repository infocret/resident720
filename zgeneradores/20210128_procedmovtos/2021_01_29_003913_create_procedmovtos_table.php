<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateprocedmovtosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedmovtos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inmueble_id')->unsigned()->default(0);
            $table->integer('conceptservice_id')->unsigned()->default(0);
            $table->integer('catmovto_id')->unsigned()->default(0);
            $table->integer('concept_cve');
            $table->integer('movto_cve');
            $table->string('procedimiento', 150);
            $table->string('parametros', 150);
            $table->integer('execauto');
            $table->string('nombre', 35);
            $table->string('desc', 150);
            $table->string('observ', 150);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('inmueble_id')->references('id')->on('inmuebles');
            $table->foreign('conceptservice_id')->references('id')->on('conceptservices');
            $table->foreign('catmovto_id')->references('id')->on('catmovtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('procedmovtos');
    }
}
