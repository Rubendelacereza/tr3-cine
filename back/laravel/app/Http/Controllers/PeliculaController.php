<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    public function index()
    {
        $peliculas = Pelicula::all();
        return response()->json($peliculas);
    }

    public function show($id)
    {
        $pelicula = Pelicula::find($id);
        return response()->json($pelicula);
    }

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

        // Guarda la nueva pelicula en la base de datos
        $pelicula->save();

        // Retorna una respuesta con la pelicula creada y un código de estado 201 (Created)
        return response()->json($pelicula, 201);
    }

    public function categories()
    {
        $categories = Pelicula::distinct('categoria')->pluck('categoria');
        return response()->json($categories);
    }   
}
