<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ButacaController;

Route::get('/peliculas', [PeliculaController::class, 'index']);
Route::get('/peliculas/{id}', [PeliculaController::class, 'show']);
Route::get('/sesiones/{id}', [SesionController::class, 'show']);
Route::get('/categories', [PeliculaController::class, 'categories']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/sesiones/{id}/butacas', [SesionController::class, 'butacas']);
Route::post('/butacas/reservar', [ButacaController::class, 'reservarButacas']); // Ruta para reservar butacas
Route::put('/butacas/{id}', [ButacaController::class, 'actualizarButaca']);
?>
