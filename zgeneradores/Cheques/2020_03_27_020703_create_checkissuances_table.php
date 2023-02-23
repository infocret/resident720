<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatecheckissuancesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkissuances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inmucharge_id')->unsigned()->default(0);
            $table->integer('propaccount_id')->unsigned()->default(0);
            $table->integer('checkbook_id')->unsigned()->default(0);
            $table->boolean('incluirleyenda');
            $table->string('datetext', 20);
            $table->string('nametext', 40);
            $table->string('amounttext', 20);
            $table->string('amountletertext', 150);
            $table->string('textleyenda', 150);
            $table->string('status', 20);
            $table->string('checknum', 20);
            $table->string('cancelchargeid', 20);
            $table->string('observ', 250);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('inmucharge_id')->references('id')->on('inmucharges');
            $table->foreign('propaccount_id')->references('id')->on('propaccounts');
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
        Schema::drop('checkissuances');
    }
}
