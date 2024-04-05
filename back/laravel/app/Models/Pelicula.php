<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    protected $fillable = [
        'titulo',
        'imagen_url',
        'duracion',
        'clasificacion',
        'categoria',
        'sinopsis',
        'trailer_url',
    ];

    public function sesiones()
    {
        return $this->hasMany(Sesion::class, 'id_pelicula');
    }
}
