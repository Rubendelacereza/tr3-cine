<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeliculasTable extends Migration
{
    public function up()
    {
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('imagen_url');
            $table->integer('duracion');
            $table->unsignedInteger('clasificacion');
            $table->string('categoria');
            $table->text('sinopsis'); // Agregar campo para la sinopsis
            $table->string('trailer_url'); // Agregar campo para el enlace del tráiler
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('peliculas');
    }
}
