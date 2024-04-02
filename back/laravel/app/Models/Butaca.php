<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Butaca extends Model
{
    protected $fillable = ['sesion_id', 'fila', 'numero', 'ocupado'];

    public function sesion()
    {
        return $this->belongsTo(Sesion::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
