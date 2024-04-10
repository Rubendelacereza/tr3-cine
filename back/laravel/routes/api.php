<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ButacaController;
use App\Http\Controllers\ReservaController;

// Rutas para las películas
Route::get('/peliculas', [PeliculaController::class, 'index']);
Route::post('/peliculas', [PeliculaController::class, 'store']);
Route::get('/peliculas/{id}', [PeliculaController::class, 'show']);
Route::delete('/peliculas/{id}', [PeliculaController::class, 'destroy']);
Route::put('/peliculas/{id}', [PeliculaController::class, 'update']);

// Rutas para las sesiones
Route::get('/sesiones', [SesionController::class, 'index']);
Route::get('/sesiones/pelicula/{id_pelicula}', [SesionController::class, 'show']);
Route::post('/sesiones', [SesionController::class, 'store']);
Route::delete('/sesiones/{id}', [SesionController::class, 'destroy']);

// Rutas para las butacas
Route::get('/butacas', [ButacaController::class, 'index']);
Route::post('/butacas', [ButacaController::class, 'crearButaca']);
Route::delete('/butacas/{id}', [ButacaController::class, 'eliminarButaca']);
Route::put('/butacas/{id}', [ButacaController::class, 'actualizarButaca']);
Route::get('/sesiones/{id}/butacas', [SesionController::class, 'butacas']);
Route::post('/butacas/reservar', [ButacaController::class, 'reservarButacas']);

// Rutas para las categorías de películas
Route::get('/categories', [PeliculaController::class, 'categories']);

// Rutas para el registro y login de usuarios
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::post('/reservas', [ReservaController::class, 'store']);
Route::get('/reservas/{id}', [ReservaController::class, 'show']);
