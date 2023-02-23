<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateperiodsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cve', 5);
            $table->string('shortname', 8);
            $table->string('name', 30);
            $table->dateTime('start_date');
            $table->dateTime('final_date');
            $table->integer('recurrence');
            $table->integer('interval');
            $table->string('unit_time', 2);
            $table->integer('business_days');
            $table->integer('sub_add_day');
            $table->string('code', 28);
            $table->string('observations', 150);
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
        Schema::drop('periods');
    }
}
