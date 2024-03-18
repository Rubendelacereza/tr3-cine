<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = ['campo1', 'campo2']; // Especifica los campos que pueden ser asignados en masa
}
