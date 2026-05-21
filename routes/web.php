<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/citas/buscar-cliente', [App\Http\Controllers\CitaController::class, 'buscarClienteByEmail'])->name('citas.buscar-cliente');

    // Rutas de Citas (Administración)
    Route::get('/citas/create', [App\Http\Controllers\CitaController::class, 'create'])->name('citas.create');

    // Rutas de Citas del Barbero por AJAX
    Route::get('/barbero/citas', [DashboardController::class, 'getCitasByFecha'])->name('barbero.citas');

    // Actualización de Perfil
    Route::post('/perfil/update', [DashboardController::class, 'updatePerfil'])->name('perfil.update');

    // CRUD de Servicios (Administrado por Barberos)
    Route::post('/servicios', [ServiceController::class, 'store'])->name('servicios.store');
    Route::put('/servicios/{service}', [ServiceController::class, 'update'])->name('servicios.update');
    Route::delete('/servicios/{service}', [ServiceController::class, 'destroy'])->name('servicios.destroy');
});

// Rutas Públicas de Citas (para landing page)
Route::post('/citas', [App\Http\Controllers\CitaController::class, 'store'])->name('citas.store');
Route::get('/citas/horas-disponibles', [App\Http\Controllers\CitaController::class, 'horasDisponibles'])->name('citas.horas-disponibles');

// Rutas Públicas de Registro Personalizado (Clientes y Barberos)
Route::middleware(['guest'])->group(function () {
    Route::get('/register-select', [RegisterController::class, 'showSelect'])->name('register.select');
    Route::get('/register/cliente', [RegisterController::class, 'showClienteForm'])->name('register.cliente');
    Route::post('/register/cliente', [RegisterController::class, 'registerCliente'])->name('register.cliente.store');
    Route::get('/register/barbero', [RegisterController::class, 'showBarberoForm'])->name('register.barbero');
    Route::post('/register/barbero', [RegisterController::class, 'registerBarbero'])->name('register.barbero.store');
});
