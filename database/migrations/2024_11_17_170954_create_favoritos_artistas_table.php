<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritosArtistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoritos_artistas', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_artista');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_artista')->references('id')->on('artistas')->onDelete('cascade');

            // Evitar duplicados en la combinación de usuario y artista
            $table->unique(['id_usuario', 'id_artista']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favoritos_artistas');
    }
}
