<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('isbn')->nullable()->default('');
            $table->integer('pageCount')->nullable()->default(0);
            $table->string('imageLink')->nullable();
            $table->date('publishedDate')->nullable();
            $table->longText('textSnippet')->nullable();
            $table->foreignId('format_id')->nullable()->constrained();
            $table->foreignId('genre_id')->nullable()->constrained();
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
        Schema::dropIfExists('books');
    }
}
