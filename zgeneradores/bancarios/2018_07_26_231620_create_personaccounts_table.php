<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatepersonaccountsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personaccounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id')->unsigned()->default(0);
            $table->integer('bankaccount_id')->unsigned()->default(0);
            $table->integer('checkbook_id')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('bankaccount_id')->references('id')->on('bankaccounts');
            $table->foreign('checkbook_id')->references('id')->on('checkbooks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('personaccounts');
    }
}
