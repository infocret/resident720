<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatestatusticketimgsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statusticketimgs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('statusticket_id')->unsigned()->default(0);
            $table->string('filename', 20);
            $table->string('link', 150);
            $table->string('observations', 150);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('statusticket_id')->references('id')->on('statustickets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('statusticketimgs');
    }
}
