<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    public function sesiones()
    {
        return $this->hasMany(Sesion::class, 'pelicula_id');
    }
}
