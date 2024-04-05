<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validar los datos de inicio de sesión enviados por el usuario
        $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required',
        ]);

        // Intentar autenticar al usuario con las credenciales proporcionadas
        if (Auth::attempt(['correo' => $request->correo, 'password' => $request->contraseña])) {
            // Si la autenticación es exitosa, obtener el usuario autenticado
            $user = Auth::user();
            // Retornar una respuesta JSON indicando el éxito del inicio de sesión junto con el usuario autenticado
            return response()->json([
                'message' => 'Inicio de sesión exitoso',
                'user' => $user,
            ], 200);
        }

        // Si la autenticación falla, devolver una respuesta JSON con un mensaje de error
        return response()->json(['message' => 'Credenciales incorrectas'], 401);
    }
}
