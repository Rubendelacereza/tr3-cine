<?php
namespace App\Http\Controllers;

use App\Models\Sesion;

class SesionController extends Controller
{
    public function show($id)
    {
        try {
            $sesiones = Sesion::where('id_pelicula', $id)->get();
            return response()->json($sesiones);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Sesiones not found for this movie'], 404);
        }
    }
}
