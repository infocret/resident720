<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatestockmovementsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockmovements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('storage_id')->unsigned()->default(0);
            $table->integer('article_id')->unsigned()->default(0);
            $table->integer('user_id')->unsigned()->default(0);
            $table->string('reference', 45);
            $table->dateTime('date');
            $table->integer('quantity');
            $table->string('mov_type', 3);
            $table->string('observations', 150);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('storage_id')->references('id')->on('storages');
            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stockmovements');
    }
}
