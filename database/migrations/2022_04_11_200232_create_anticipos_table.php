<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnticiposTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anticipos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('condom_id')->unsigned()->default(0);
            $table->integer('unid_id')->unsigned()->default(0);
            $table->integer('conceptserv_id')->unsigned()->default(0);
            $table->dateTime('fechareg');
            $table->string('folio', 35);
            $table->string('cobertura', 150);
            $table->decimal('montoini', 19, 4);
            $table->decimal('saldo', 19, 4);
            $table->string('status', 15);
            $table->string('desc', 150);
            $table->string('observ', 250);
            $table->string('docto', 150);
            $table->string('filelink', 250);
            $table->string('userreg', 150);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('condom_id')->references('id')->on('inmuebles');
            $table->foreign('unid_id')->references('id')->on('inmuebles');
            $table->foreign('conceptserv_id')->references('id')->on('conceptservices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('anticipos');
    }
}
