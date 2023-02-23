<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatestatusticketsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statustickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ticket_id')->unsigned()->default(0);
            $table->integer('user_id')->unsigned()->default(0);
            $table->date('status_date');
            $table->string('status', 15);
            $table->string('observations', 150);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('ticket_id')->references('id')->on('tickets');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('statustickets');
    }
}
