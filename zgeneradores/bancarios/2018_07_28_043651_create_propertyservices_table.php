<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatepropertyservicesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propertyservices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cve', 3);
            $table->string('shortname', 8);
            $table->string('name', 25);
            $table->string('description', 50);
            $table->string('content', 150);
            $table->string('privileges', 150);
            $table->string('obligations', 150);
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
        Schema::drop('propertyservices');
    }
}
