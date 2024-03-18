<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Butaca extends Model
{
    protected $table = 'butacas';

    protected $fillable = ['numero', 'estado', 'sesion_id'];

    public function sesion()
    {
        return $this->belongsTo(Sesion::class);
    }
}
