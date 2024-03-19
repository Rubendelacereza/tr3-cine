<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\SesionController;

Route::get('/peliculas', [PeliculaController::class, 'index']);
Route::get('/peliculas/{id}', [PeliculaController::class, 'show']);
Route::get('/sesiones/{id}', [SesionController::class, 'show']); // Ruta para obtener una sesión específica
Route::get('/categories', [PeliculaController::class, 'categories']); // Ruta para obtener las categorías de las películas
