<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreaterelationshipPropertiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationship_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_property')->unsigned()->default(0);
            $table->integer('son_property')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('parent_property')->references('id')->on('inmuebles');
            $table->foreign('son_property')->references('id')->on('inmuebles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('relationship_properties');
    }
}
