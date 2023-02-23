<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatecheckbookprintsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkbookprints', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checkbook_id')->unsigned()->default(0);
            $table->string('desc', 25);
            $table->string('imgsample', 150);
            $table->string('cssfile', 150);
            $table->timestamps();
            $table->softDeletes();
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
        Schema::drop('checkbookprints');
    }
}
