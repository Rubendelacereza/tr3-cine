<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
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
        // Método para crear una nueva reserva
        $data = $request->validate([
            // Validación de los datos de la reserva
        ]);

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
        $reserva->delete();
        return response()->json(null, 204);
    }
}
