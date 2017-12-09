<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendingBooksUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_books_update', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id');
            $table->boolean('pending_deletion')->default(false);
            $table->string('column')->nullable();
            $table->string('new_value')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('pending_books_update');
    }
}
