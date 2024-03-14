<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;

class PeliculaController extends Controller
{
    public function index()
    {
        $peliculas = Pelicula::all();
        return response()->json($peliculas);
    }

    public function show($id)
    {
        try {
            $pelicula = Pelicula::findOrFail($id);
            return response()->json($pelicula);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Pelicula not found'], 404);
        }
    }
}
