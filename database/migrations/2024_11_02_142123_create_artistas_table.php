<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistasTable extends Migration
{
    public function up()
    {
        Schema::create('artistas', function (Blueprint $table) {
            $table->id(); // Esto crea una clave primaria de tipo unsignedBigInteger llamada 'id'
            $table->string('nombre');
            $table->string('apellidos');
            $table->date('fecha_nacimiento');
            $table->string('nie')->unique();
            $table->text('biografia')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->enum('experiencia', ['Principiante', 'Intermedio', 'Avanzado', 'Experto'])->default('Principiante');
            $table->unsignedBigInteger('id_role'); // Llave foránea para los roles
            $table->string('email')->unique(); // Agregando el email, necesario para autenticación
            $table->string('password'); // Contraseña del artista
            $table->rememberToken(); // Token para recordar sesiones
            $table->timestamps();

            // Definición de la relación de la llave foránea
            $table->foreign('id_role')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('artistas');
    }
}
