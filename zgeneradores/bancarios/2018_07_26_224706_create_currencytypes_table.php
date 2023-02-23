<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatecurrencytypesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencytypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('territory', 50);
            $table->string('currency', 35);
            $table->string('symbol', 10);
            $table->string('iso_code', 4);
            $table->string('fractional_unit', 35);
            $table->string('base_number', 6);
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
        Schema::drop('currencytypes');
    }
}
