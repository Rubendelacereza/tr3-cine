<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Butaca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ReservaController extends Controller
{
    // Método para mostrar los detalles de una reserva por su ID
    public function show($id)
{
    // Buscar la reserva por su ID
    $reserva = Reserva::find($id);

    // Verificar si la reserva existe
    if (!$reserva) {
        return response()->json(['message' => 'La reserva no existe'], 404);
    }

    // Devolver los detalles de la reserva
    return response()->json($reserva);
}

    // Método para crear una nueva reserva
    public function store(Request $request)
    {
        $request->validate([
            'butacasSeleccionadas' => 'required|array',
            'sesionId' => 'required|exists:sesiones,id',
            'userId' => 'required|exists:usuarios,id',
        ]);

        $userId = $request->userId;

        foreach ($request->butacasSeleccionadas as $butacaId) {
            // Verificar si la butaca está ocupada
            $butaca = Butaca::find($butacaId);
            if (!$butaca) {
                return response()->json(['message' => 'La butaca no existe'], 404);
            }
            if ($butaca->ocupado) {
                return response()->json(['message' => 'La butaca ya está ocupada'], 400);
            }

            // Guardar la reserva
            $reserva = new Reserva();
            $reserva->butaca_id = $butacaId;
            $reserva->sesion_id = $request->sesionId;
            $reserva->user_id = $userId;
            $reserva->codigo_ticket = $this->generarCodigoTicket();
            $reserva->save();

            // Marcar la butaca como ocupada
            $butaca->ocupado = 1;
            $butaca->save();
        }

        return response()->json($reserva, 201);
    }

    private function generarCodigoTicket()
    {
        return Str::uuid()->toString();
    }
}
