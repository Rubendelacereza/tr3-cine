<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    protected $table = 'sesiones'; // Nombre de la tabla en la base de datos

    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class, 'pelicula_id');
    }
}
