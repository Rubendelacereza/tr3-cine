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
            $table->string('cliente_nombre');
            $table->string('cliente_email');
            $table->string('codigo_ticket')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
