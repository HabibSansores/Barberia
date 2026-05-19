<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas de Citas (Administración)
    Route::get('/citas/create', [App\Http\Controllers\CitaController::class, 'create'])->name('citas.create');
});

// Rutas Públicas de Citas (para landing page)
Route::post('/citas', [App\Http\Controllers\CitaController::class, 'store'])->name('citas.store');
Route::get('/citas/horas-disponibles', [App\Http\Controllers\CitaController::class, 'horasDisponibles'])->name('citas.horas-disponibles');
