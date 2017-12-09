<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookDimensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_dimensions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id')->unique();
            $table->double('weight')->nullable();
            $table->double('height');
            $table->double('width');
            $table->double('thickness');
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
        Schema::dropIfExists('book_dimensions');
    }
}
