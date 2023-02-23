<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatebankaccountsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bankaccounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bank_id')->unsigned()->default(0);
            $table->integer('banksquare_id')->unsigned()->default(0);
            $table->string('ident', 3);
            $table->string('name', 3);
            $table->string('account', 3);
            $table->string('clabe', 3);
            $table->string('description', 3);
            $table->string('currency_type', 3);
            $table->dateTime('opening_date');
            $table->string('account_type', 3);
            $table->string('accounting', 3);
            $table->integer('allow_overdrafts');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('banksquare_id')->references('id')->on('banksquares');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bankaccounts');
    }
}
