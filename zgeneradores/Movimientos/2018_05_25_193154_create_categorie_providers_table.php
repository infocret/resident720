<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatecategorieProvidersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorie_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provcat_id')->unsigned()->default(0);
            $table->integer('provider_id')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('provcat_id')->references('id')->on('provcats');
            $table->foreign('provider_id')->references('id')->on('providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categorie_providers');
    }
}
