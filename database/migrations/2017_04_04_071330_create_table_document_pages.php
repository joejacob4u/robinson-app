<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocumentPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_document_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('doc_page_no');
            $table->text('doc_page_content');
            $table->integer('doc_id')->unsigned();
            $table->foreign('doc_id')->references('id')->on('tbl_document');
            $table->text('tags');
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
        Schema::drop('tbl_document_pages');
    }
}
