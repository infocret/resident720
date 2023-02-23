<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatecheckbooksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bankaccount_id')->unsigned()->default(0);
            $table->string('shortname', 8);
            $table->string('fullname', 35);
            $table->string('description', 150);
            $table->string('start', 12);
            $table->string('end', 12);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('bankaccount_id')->references('id')->on('bankaccounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('checkbooks');
    }
}
