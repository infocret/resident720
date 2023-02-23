<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatecatmovtosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catmovtos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conceptserv_id')->unsigned()->default(0);
            $table->integer('cve');
            $table->string('tipo', 1);
            $table->string('shortname', 12);
            $table->string('name', 60);
            $table->string('description', 150);
            $table->string('observ', 250);
            $table->timestamp('deleted_at');
            $table->timestamps();
            $table->softDeletes();
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
        Schema::drop('catmovtos');
    }
}
