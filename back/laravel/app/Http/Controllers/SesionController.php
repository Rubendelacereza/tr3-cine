<?php

namespace App\Http\Controllers;

use App\Models\Sesion;

class SesionController extends Controller
{
    public function show($id)
    {
        try {
            // Cargar las sesiones junto con las butacas asociadas
            $sesiones = Sesion::with('butacas')->where('id_pelicula', $id)->get();
            return response()->json($sesiones);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Sesiones not found for this movie'], 404);
        }
    }

    public function butacas($id)
    {
        try {
            // Obtener las butacas asociadas a la sesión con el ID dado
            $butacas = Sesion::findOrFail($id)->butacas;
            return response()->json($butacas);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Butacas not found for this session'], 404);
        }
    }
}
