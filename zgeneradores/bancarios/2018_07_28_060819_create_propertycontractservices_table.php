<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatepropertycontractservicesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propertycontractservices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_id')->unsigned()->default(0);
            $table->integer('propertyservice_id')->unsigned()->default(0);
            $table->integer('period_id')->unsigned()->default(0);
            $table->decimal('amount', 19, 4);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('contract_id')->references('id')->on('contracts');
            $table->foreign('propertyservice_id')->references('id')->on('propertyservices');
            $table->foreign('period_id')->references('id')->on('periods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('propertycontractservices');
    }
}
