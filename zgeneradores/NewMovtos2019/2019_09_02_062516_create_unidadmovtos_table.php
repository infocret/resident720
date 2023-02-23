<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateunidadmovtosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidadmovtos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inmu_id')->unsigned()->default(0);
            $table->integer('movto_id')->unsigned()->default(0);
            $table->string('periodap', 25);
            $table->string('validity', 25);
            $table->decimal('amount', 19, 4);
            $table->dateTime('nextap');
            $table->dateTime('endvalidity');
            $table->string('observ', 250);
            $table->timestamp('deleted_at');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('inmu_id')->references('id')->on('inmuebles');
            $table->foreign('movto_id')->references('id')->on('catmovtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('unidadmovtos');
    }
}
