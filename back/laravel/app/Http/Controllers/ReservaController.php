<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva; // Asegúrate de importar el modelo de Reserva si no lo has hecho ya

class ReservaController extends Controller
{
    // Otros métodos...

    public function mostrarReservas($id)
    {
        $reserva = Reserva::find($id);

        if (!$reserva) {
            return response()->json(['error' => 'Reserva no encontrada'], 404);
        }

        return response()->json($reserva, 200);
    }

    public function eliminarReserva($id)
    {
        $reserva = Reserva::find($id);

        if (!$reserva) {
            return response()->json(['error' => 'Reserva no encontrada'], 404);
        }

        $reserva->delete();

        return response()->json(['message' => 'Reserva eliminada exitosamente'], 200);
    }
}
