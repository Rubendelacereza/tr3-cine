<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    // Método para obtener todas las películas
    public function index()
    {
        // Obtener todas las películas de la base de datos
        $peliculas = Pelicula::all();
        
        // Devolver las películas como una respuesta JSON
        return response()->json($peliculas);
    }

    // Método para eliminar una película por su ID
    public function destroy($id)
    {
        // Buscar la película por su ID
        $pelicula = Pelicula::find($id);

        // Verificar si la película existe
        if (!$pelicula) {
            // Si la película no existe, devolver un mensaje de error con un código de estado 404 (Not Found)
            return response()->json(['message' => 'Pelicula no encontrada'], 404);
        }

        // Eliminar la película
        $pelicula->delete();

        // Devolver un mensaje de éxito
        return response()->json(['message' => 'Pelicula eliminada correctamente']);
    }

    // Método para mostrar los detalles de una película por su ID
    public function show($id)
    {
        // Buscar la película por su ID
        $pelicula = Pelicula::find($id);

        // Devolver los detalles de la película como una respuesta JSON
        return response()->json($pelicula);
    }

    // Método para almacenar una nueva película
    public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'titulo' => 'required|string',
            'imagen_url' => 'required|string',
            'duracion' => 'required|integer',
            'clasificacion' => 'required|integer',
            'categoria' => 'required|string',
            'sinopsis' => 'required|string',
            'trailer_url' => 'required|string',
        ]);
        
        // Crea una nueva instancia de Pelicula con los datos del formulario
        $pelicula = new Pelicula([
            'titulo' => $request->input('titulo'),
            'imagen_url' => $request->input('imagen_url'),
            'duracion' => $request->input('duracion'),
            'clasificacion' => $request->input('clasificacion'),
            'categoria' => $request->input('categoria'),
            'sinopsis' => $request->input('sinopsis'),
            'trailer_url' => $request->input('trailer_url'),
        ]);

        // Guarda la nueva película en la base de datos
        $pelicula->save();

        // Retorna una respuesta con la película creada y un código de estado 201 (Created)
        return response()->json($pelicula, 201);
    }

    // Método para obtener las categorías únicas de todas las películas
    public function categories()
    {
        // Obtener las categorías únicas de las películas
        $categories = Pelicula::distinct('categoria')->pluck('categoria');
        
        // Devolver las categorías como una respuesta JSON
        return response()->json($categories);
    }   
}
