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
        $pelicula = Pelicula::find($id);
        return response()->json($pelicula);
    }
}
