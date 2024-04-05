<?php

namespace App\Http\Controllers;

use App\Models\Sesion;
use Illuminate\Http\Request;

class SesionController extends Controller
{
    // Método para obtener todas las sesiones
    public function index()
{
    try {
        // Obtener todas las sesiones de la base de datos junto con las películas asociadas
        $sesiones = Sesion::with('pelicula')->get();
        
        // Devolver las sesiones como una respuesta JSON
        return response()->json($sesiones);
    } catch (\Exception $e) {
        // En caso de error, devolver un mensaje de error con un código de estado 500 (Internal Server Error)
        return response()->json(['message' => 'Error fetching sessions: ' . $e->getMessage()], 500);
    }
}

    // Método para mostrar las sesiones de una película por su ID
    public function show($id)
    {
        try {
            // Cargar las sesiones junto con las butacas asociadas para una película específica
            $sesiones = Sesion::with('butacas')->where('id_pelicula', $id)->get();
            
            // Devolver las sesiones de la película como una respuesta JSON
            return response()->json($sesiones);
        } catch (\Exception $e) {
            // Si no se encuentran sesiones para la película, devolver un mensaje de error con un código de estado 404 (Not Found)
            return response()->json(['message' => 'Sesiones not found for this movie'], 404);
        }
    }

    // Método para obtener las butacas de una sesión por su ID
    public function butacas($id)
    {
        try {
            // Obtener las butacas asociadas a la sesión con el ID dado
            $butacas = Sesion::findOrFail($id)->butacas;
            
            // Devolver las butacas como una respuesta JSON
            return response()->json($butacas);
        } catch (\Exception $e) {
            // Si no se encuentran butacas para la sesión, devolver un mensaje de error con un código de estado 404 (Not Found)
            return response()->json(['message' => 'Butacas not found for this session'], 404);
        }
    }

    // Método para almacenar una nueva sesión
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

            // Crear una nueva instancia de Sesion con los datos de la solicitud
            $sesion = new Sesion();
            $sesion->id_pelicula = $request->id_pelicula;
            $sesion->fecha = $request->fecha;
            $sesion->hora = $request->hora;
            $sesion->save();

            // Devolver la sesión creada como una respuesta JSON con un código de estado 201 (Created)
            return response()->json($sesion, 201);
        } catch (\Exception $e) {
            // En caso de error, devolver un mensaje de error con un código de estado 500 (Internal Server Error)
            return response()->json(['message' => 'Error creating session: ' . $e->getMessage()], 500);
        }
    }
}
