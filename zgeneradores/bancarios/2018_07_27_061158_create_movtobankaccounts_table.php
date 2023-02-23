<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatemovtobankaccountsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movtobankaccounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movtohead_id')->unsigned()->default(0);
            $table->integer('checkbook_id')->unsigned()->default(0);
            $table->integer('bankaccount_id')->unsigned()->default(0);
            $table->string('nchbook_ntrx_ref', 35);
            $table->string('owner', 55);
            $table->decimal('amount', 19, 4);
            $table->integer('partial_payment');
            $table->string('observations', 150);
            $table->decimal('Head_balance_Amount', 19, 4);
            $table->string('status', 15);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('movtohead_id')->references('id')->on('movtoheads');
            $table->foreign('checkbook_id')->references('id')->on('checkbooks');
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
        Schema::drop('movtobankaccounts');
    }
}
