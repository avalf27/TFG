
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('favoritos_exposiciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario')->nullable(); // Esto será nullable para los usuarios
            $table->unsignedBigInteger('id_artista')->nullable(); // Esto será nullable para los artistas
            $table->unsignedBigInteger('id_exposicion'); // Referencia a la exposición
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_artista')->references('id')->on('artistas')->onDelete('cascade');
            $table->foreign('id_exposicion')->references('id')->on('exposiciones')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('favoritos_exposiciones');
    }
};
