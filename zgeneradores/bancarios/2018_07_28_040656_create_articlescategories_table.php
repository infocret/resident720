<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatearticlescategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articlescategories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cve', 8);
            $table->string('shortname', 8);
            $table->string('name', 20);
            $table->string('description', 35);
            $table->string('observations', 150);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articlescategories');
    }
}
