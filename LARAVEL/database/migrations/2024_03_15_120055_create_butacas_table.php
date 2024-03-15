<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateButacasTable extends Migration
{
    public function up()
    {
        Schema::create('butacas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sesion_id')->constrained('sesiones');
            // Agrega aquí las columnas necesarias para las butacas
            $table->string('estado'); // Ejemplo de columna para el estado de la butaca (ocupada, disponible, etc.)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('butacas');
    }
}
