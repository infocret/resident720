<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonaDocumentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id')->unsigned()->default(0);
            $table->integer('doctype_id')->unsigned()->default(0);
            $table->string('path', 250);
            $table->string('filename', 100);
            $table->string('link', 250);
            $table->integer('activ', false, true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('doctype_id')->references('id')->on('doc_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('persona_documents');
    }
}
