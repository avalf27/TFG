<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasArteTable extends Migration
{
    public function up()
    {
        Schema::create('obras_arte', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->date('año');
            $table->double('precio')->nullable();
            $table->string('imagen')->nullable();
            $table->enum('estado', ['disponible', 'vendido', 'no se vende'])->default('disponible');

            // Agregar la columna 'artista_id' como unsignedBigInteger
            $table->unsignedBigInteger('id_artista');

            // Crear la clave foránea para enlazar con la tabla 'artistas'
            $table->foreign('id_artista')->references('id')->on('artistas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('obras_arte');
    }
}
