<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
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
            'contraseña' => Hash::make($request->contraseña), // Hashear la contraseña usando Hash::make
        ]);

        // Retornar una respuesta JSON indicando el éxito del registro
        return response()->json(['message' => 'Usuario registrado con éxito'], 201);
    }
}
