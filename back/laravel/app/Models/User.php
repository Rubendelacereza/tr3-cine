<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id'; // Asegúrate de especificar la clave primaria si es diferente de 'id'

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'correo',
        'contraseña', // Mantenemos 'contraseña' si es el nombre de tu campo en la base de datos
    ];

    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Especifica explícitamente el nombre del campo de la contraseña
    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}
