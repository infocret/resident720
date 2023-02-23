<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateconceptservicesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conceptservices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cve');
            $table->string('shortname', 12);
            $table->string('name', 60);
            $table->string('description', 150);
            $table->string('observ', 250);
            $table->timestamp('deleted_at');
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
        Schema::drop('conceptservices');
    }
}
