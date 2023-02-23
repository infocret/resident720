<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateinmumovtosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmumovtos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inmucharg_id')->unsigned()->default(0);
            $table->integer('unidmovto_id')->unsigned()->default(0);
            $table->integer('catmovto_cve');
            $table->dateTime('date');
            $table->string('folio', 35);
            $table->decimal('quantity', 19, 4);
            $table->integer('measureunit_id')->unsigned()->default(0);
            $table->decimal('amount', 19, 4);
            $table->decimal('balance', 19, 4);
            $table->string('status', 15);
            $table->string('apmode', 35);
            $table->string('description', 150);
            $table->string('observ', 250);
            $table->string('filelink', 250);
            $table->timestamp('deleted_at');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('inmucharg_id')->references('id')->on('inmucharges');
            $table->foreign('unidmovto_id')->references('id')->on('unidadmovtos');
            $table->foreign('measureunit_id')->references('id')->on('measureunits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inmumovtos');
    }
}
