<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\RegisterController;

Route::get('/peliculas', [PeliculaController::class, 'index']);
Route::get('/peliculas/{id}', [PeliculaController::class, 'show']);
Route::get('/sesiones/{id}', [SesionController::class, 'show']); // Ruta para obtener una sesión específica
Route::get('/categories', [PeliculaController::class, 'categories']); // Ruta para obtener las categorías de las películas
Route::post('/register', [RegisterController::class, 'register']); // Ruta para registrar un nuevo usuario

