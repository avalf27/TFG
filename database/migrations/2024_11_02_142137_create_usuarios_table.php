<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->date('fecha_nacimiento');
            $table->string('nie')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('id_role'); // Relación con la tabla roles
            $table->foreign('id_role')->references('id')->on('roles')->onDelete('cascade'); // Clave foránea
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
