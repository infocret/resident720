<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatemovdetailappliesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movdetailapplies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movtobankaccount_id')->unsigned()->default(0);
            $table->integer('movtodetail_id')->unsigned()->default(0);
            $table->dateTime('applie_date');
            $table->decimal('amount_applied', 19, 4);
            $table->decimal('detail_balance_amount', 19, 4);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('movtobankaccount_id')->references('id')->on('movtobankaccounts');
            $table->foreign('movtodetail_id')->references('id')->on('movtodetails');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('movdetailapplies');
    }
}
