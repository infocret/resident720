<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersInmuReltipoReqDocsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pers_inmu_reltipo_req_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reltipo_id')->unsigned()->default(0);
            $table->integer('doctype_id')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('reltipo_id')->references('id')->on('persona_inmueble_reltipos');
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
        Schema::drop('pers_inmu_reltipo_req_docs');
    }
}
