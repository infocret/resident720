<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatearticlesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('articlescategorie_id')->unsigned()->default(0);
            $table->string('cve', 8);
            $table->string('shortname', 8);
            $table->string('name', 20);
            $table->string('description', 35);
            $table->string('measurement', 5);
            $table->string('barcode', 50);
            $table->string('observations', 150);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('articlescategorie_id')->references('id')->on('articlescategories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
