<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Butaca;

class ButacaController extends Controller
{
    // Método para obtener las butacas y sus precios para una sesión específica
    public function obtenerButacasConPrecios($sesionId)
    {
        try {
            // Buscar las butacas para la sesión específica
            $butacas = Butaca::where('sesion_id', $sesionId)->get();

            // Retornar las butacas junto con sus precios en una respuesta JSON
            return response()->json(['butacas' => $butacas], 200);
        } catch (\Exception $e) {
            // Retornar una respuesta JSON indicando un error si no se pueden obtener las butacas
            return response()->json(['message' => 'Error al obtener las butacas'], 500);
        }
    }

    // Método para actualizar el estado de ocupado de una butaca
    public function actualizarButaca($id)
    {
        try {
            // Buscar la butaca por su ID
            $butaca = Butaca::findOrFail($id);

            // Actualizar el estado de ocupado a true
            $butaca->ocupado = true;
            $butaca->save();

            // Retornar una respuesta JSON indicando que se ha actualizado la butaca correctamente
            return response()->json(['message' => 'Butaca actualizada correctamente'], 200);
        } catch (\Exception $e) {
            // Retornar una respuesta JSON indicando un error si la butaca no se encuentra o no se puede actualizar
            return response()->json(['message' => 'Error al actualizar la butaca'], 500);
        }
    }
}

?>