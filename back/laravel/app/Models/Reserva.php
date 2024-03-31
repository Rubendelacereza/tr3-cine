<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = ['usuario_id', 'sesion_id', 'butaca_id'];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function sesion()
    {
        return $this->belongsTo(Sesion::class);
    }

    public function butaca()
    {
        return $this->belongsTo(Butaca::class);
    }
}
