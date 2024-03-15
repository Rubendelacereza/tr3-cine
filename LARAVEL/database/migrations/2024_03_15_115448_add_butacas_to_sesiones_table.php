<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sesiones', function (Blueprint $table) {
            $table->string('estado_butaca')->default('disponible'); // Cambia el tipo y el valor predeterminado según tus necesidades
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('sesiones', function (Blueprint $table) {
        $table->dropColumn('estado_butaca');
    });
}
};
