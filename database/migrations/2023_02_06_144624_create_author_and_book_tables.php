<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorAndBookTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('country', 255);
        });

        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 1000);
            $table->string('publisher', 1000);
            $table->integer('number_of_pages');
            $table->boolean('is_published');
        });

        Schema::create('book_has_author', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('book_id');
            $table->foreign('author_id')->references('id')->on('authors');
            $table->foreign('book_id')->references('id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_has_author');
        Schema::dropIfExists('books');
        Schema::dropIfExists('authors');
    }
}
