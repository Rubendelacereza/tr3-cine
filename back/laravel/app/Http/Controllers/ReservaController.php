<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Butaca;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()
    {
        // Método para mostrar todas las reservas
        $reservas = Reserva::all();
        return response()->json($reservas);
    }

    public function store(Request $request)
    {
        // Validar los datos de la reserva
        $data = $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'sesion_id' => 'required|exists:sesiones,id',
            'butaca_id' => 'required|exists:butacas,id',
        ]);

        // Verificar la disponibilidad de la butaca
        $butaca = Butaca::findOrFail($data['butaca_id']);
        if ($butaca->ocupado) {
            return response()->json(['message' => 'La butaca seleccionada ya está ocupada'], 400);
        }

        // Marcar la butaca como ocupada
        $butaca->update(['ocupado' => true]);

        // Crear la reserva
        $reserva = Reserva::create($data);

        return response()->json($reserva, 201);
    }

    public function show($id)
    {
        // Método para mostrar una reserva específica
        $reserva = Reserva::findOrFail($id);
        return response()->json($reserva);
    }

    public function update(Request $request, $id)
    {
        // Método para actualizar una reserva existente
        $reserva = Reserva::findOrFail($id);
        $data = $request->validate([
            // Validación de los datos de la reserva
        ]);
        $reserva->update($data);
        return response()->json($reserva, 200);
    }

    public function destroy($id)
    {
        // Método para eliminar una reserva existente
        $reserva = Reserva::findOrFail($id);

        // Marcar la butaca asociada como desocupada
        $butaca = $reserva->butaca;
        $butaca->update(['ocupado' => false]);

        $reserva->delete();
        return response()->json(null, 204);
    }
}
