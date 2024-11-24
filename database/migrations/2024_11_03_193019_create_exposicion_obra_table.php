<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExposicionObraTable extends Migration
{
    public function up()
    {
        Schema::create('exposicion_obra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_exposicion');
            $table->unsignedBigInteger('id_obra');
            $table->foreign('id_exposicion')->references('id')->on('exposiciones')->onDelete('cascade');
            $table->foreign('id_obra')->references('id')->on('obras_arte')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exposicion_obra');
    }
}
