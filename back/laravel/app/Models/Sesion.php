<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    protected $table = 'sesiones'; // Especificar el nombre de la tabla correctamente

    protected $fillable = [
        'id_pelicula',
        'fecha',
        'hora',
    ];

    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class, 'id_pelicula');
    }
}
