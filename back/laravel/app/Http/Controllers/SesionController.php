<?php

namespace App\Http\Controllers;

use App\Models\Sesion;
use Illuminate\Http\Request;

class SesionController extends Controller
{
    public function index()
{
    try {
        // Obtener todas las sesiones
        $sesiones = Sesion::all();
        return response()->json($sesiones);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error fetching sessions: ' . $e->getMessage()], 500);
    }
}
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

    public function store(Request $request)
    {
        try {
            // Validar los datos de la solicitud
            $request->validate([
                'id_pelicula' => 'required|exists:peliculas,id',
                'fecha' => 'required|date',
                'hora' => 'required|date_format:H:i',
                // Añade más validaciones según sea necesario
            ]);

            // Crear una nueva sesión
            $sesion = new Sesion();
            $sesion->id_pelicula = $request->id_pelicula;
            $sesion->fecha = $request->fecha;
            $sesion->hora = $request->hora;
            $sesion->save();

            return response()->json($sesion, 201); // Devuelve la sesión creada con código de estado 201 (Created)
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating session: ' . $e->getMessage()], 500);
        }
    }
}
