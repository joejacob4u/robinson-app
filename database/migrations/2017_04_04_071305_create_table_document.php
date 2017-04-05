<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocument extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('tbl_document', function (Blueprint $table) {
            $table->increments('id');
            $table->string('doc_name');
            $table->string('doc_author');
            $table->integer('cat_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('tbl_category');
            $table->dateTime('publish_date');
            $table->text('doc_cover');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_document');
    }
}
