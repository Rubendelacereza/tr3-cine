<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Butaca;

class ButacaController extends Controller
{
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
