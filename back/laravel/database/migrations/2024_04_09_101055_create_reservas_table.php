<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('butaca_id')->constrained('butacas');
            $table->foreignId('sesion_id')->constrained('sesiones');
            $table->foreignId('user_id')->constrained('usuarios'); // Agregar la columna para almacenar el ID del usuario
            $table->string('codigo_ticket')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
