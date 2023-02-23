<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatestocksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('storage_id')->unsigned()->default(0);
            $table->integer('article_id')->unsigned()->default(0);
            $table->integer('stock');
            $table->string('location', 35);
            $table->integer('stock_max');
            $table->integer('stock_min');
            $table->string('observations', 150);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('storage_id')->references('id')->on('storages');
            $table->foreign('article_id')->references('id')->on('articles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stocks');
    }
}
