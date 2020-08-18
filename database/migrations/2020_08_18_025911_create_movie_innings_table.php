<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieInningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_innings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pelicula')->unsigned();
            $table->bigInteger('id_turno')->unsigned();
            $table->timestamps();

            $table->foreign('id_pelicula')->references('id')->on('movies');
            $table->foreign('id_turno')->references('id')->on('innings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_innings');
    }
}
