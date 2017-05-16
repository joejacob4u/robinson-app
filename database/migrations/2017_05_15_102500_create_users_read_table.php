<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersReadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_book_read', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('book_id');
            $table->integer('page_no');
            $table->string('status');
            $table->boolean('processed')->default(0);
            $table->text('transcription');
            $table->integer('accuracy');
            $table->timestamps();
        });

        Schema::create('users_document_read', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('document_id');
            $table->integer('page_no');
            $table->string('status');
            $table->boolean('processed')->default(0);
            $table->text('transcription');
            $table->integer('accuracy');
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
        Schema::dropIfExists('users_read');
    }
}
