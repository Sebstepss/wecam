<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Ruta para la página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Autenticación predeterminada de Laravel (login, registro, etc.)
Auth::routes();

// Ruta protegida para el home, accesible solo por usuarios autenticados
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');