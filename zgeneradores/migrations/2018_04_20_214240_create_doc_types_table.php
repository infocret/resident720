<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocTypesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('filetype_id')->unsigned()->default(0);
            $table->string('nombre', 100);
            $table->integer('sizemin');
            $table->integer('sizemax');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('filetype_id')->references('id')->on('file_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('doc_types');
    }
}
