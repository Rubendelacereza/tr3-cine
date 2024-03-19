<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Asegúrate de importar el modelo User
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // Validar los datos del formulario de registro
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'telefono' => 'required|string|unique:usuarios',
            'correo' => 'required|email|unique:usuarios',
            'contraseña' => 'required|string|min:8',
        ]);

        // Crear un nuevo usuario en la base de datos
        $user = User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'contraseña' => Hash::make($request->contraseña),
        ]);
        

        // Retornar una respuesta JSON indicando el éxito del registro
        return response()->json(['message' => 'Usuario registrado con éxito'], 201);
    }
}
