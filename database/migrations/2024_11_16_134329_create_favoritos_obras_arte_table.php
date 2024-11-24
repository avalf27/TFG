<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('favoritos_obras_arte', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_obra');
            $table->timestamps();
    
            // Foreign keys
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_obra')->references('id')->on('obras_arte')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('favoritos_obras_arte');
    }
    
};
