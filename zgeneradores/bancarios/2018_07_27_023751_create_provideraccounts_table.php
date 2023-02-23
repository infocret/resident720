<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateprovideraccountsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provideraccounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id')->unsigned()->default(0);
            $table->integer('bankaccount_id')->unsigned()->default(0);
            $table->integer('checkbook_id')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('provider_id')->references('id')->on('providers');
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
        Schema::drop('provideraccounts');
    }
}
