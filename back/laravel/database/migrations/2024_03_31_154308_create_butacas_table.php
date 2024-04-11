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
            $table->integer('fila');
            $table->integer('numero');
            $table->decimal('precio', 8, 2)->default(0.00); // Añadimos el campo 'precio'
            $table->boolean('ocupado')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('butacas');
    }
}
