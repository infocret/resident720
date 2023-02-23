<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonaImagesidsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_imagesids', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id')->unsigned()->default(0);
            $table->text('link', 250);
            $table->string('filename', 150);
            $table->integer('activ', false, true);
            $table->timestamps();
            $table->softDeletes();
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
        Schema::drop('persona_imagesids');
    }
}
