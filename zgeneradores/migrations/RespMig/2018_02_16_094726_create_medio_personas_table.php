<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedioPersonasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medio_personas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medio_id')->unsigned()->default(0);
            $table->integer('persona_id')->unsigned()->default(0);
            $table->string('dato', 50);
            $table->string('observaciones', 100);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('medio_id')->references('id')->on('medios');
            $table->foreign('persona_id')->references('id')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medio_personas');
    }
}
