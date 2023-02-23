<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnticiposaplisTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anticiposaplis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anticipo_id')->unsigned()->default(0);
            $table->integer('inmucharg_id')->unsigned()->default(0);
            $table->integer('inmumovto_id')->unsigned()->default(0);
            $table->dateTime('fechareg');
            $table->decimal('saldoini', 19, 4);
            $table->decimal('monto', 19, 4);
            $table->decimal('saldofin', 19, 4);
            $table->string('status', 15);
            $table->string('apmode', 35);
            $table->string('desc', 150);
            $table->string('observ', 250);
            $table->string('userreg', 150);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('anticipo_id')->references('id')->on('anticipos');
            $table->foreign('inmucharg_id')->references('id')->on('inmucharges');
            $table->foreign('inmumovto_id')->references('id')->on('inmumovtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('anticiposaplis');
    }
}
