<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('classification')->nullable();

            $table->integer('minutes')->default(0);
            $table->integer('year')->default(0);

            $table->string('cover')->default('movie.png');
            $table->string('trailer')->nullable();

            $table->unsignedBigInteger('category_id');

            $table->foreign('category_id')->references('id')->on('categories')
            ->onDelete('cascade');

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
        Schema::dropIfExists('movies');
    }
}
