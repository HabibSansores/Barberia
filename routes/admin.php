<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BarberController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\AppointmentController;

Route::get('/', function () {
    $today = \Carbon\Carbon::today();

    // ── Métricas principales (desde tabla citas - el sistema real) ──
    $citasHoy         = \App\Models\Cita::whereDate('fecha', $today)->count();
    $citasPendientes  = \App\Models\Cita::whereIn('estado', ['Pendiente', 'pendiente', 'Confirmada', 'confirmada'])->count();
    $totalBarberos    = \App\Models\User::role('Barbero')->count();
    $citasEsteMes     = \App\Models\Cita::whereMonth('fecha', $today->month)
                            ->whereYear('fecha', $today->year)->count();

    // ── Datos para gráficas ──

    // 1. Citas por estado (donut chart)
    $citasPorEstado = \App\Models\Cita::selectRaw('estado, COUNT(*) as total')
        ->groupBy('estado')
        ->orderByDesc('total')
        ->get();

    // 2. Citas por barbero - top 5 (bar chart)
    $citasPorBarbero = \App\Models\Cita::selectRaw('barbero, COUNT(*) as total')
        ->groupBy('barbero')
        ->orderByDesc('total')
        ->limit(5)
        ->get();

    // 3. Citas de los últimos 7 días (line chart)
    $citasUltimos7Dias = collect();
    for ($i = 6; $i >= 0; $i--) {
        $fecha = \Carbon\Carbon::now()->subDays($i)->toDateString();
        $total = \App\Models\Cita::whereDate('fecha', $fecha)->count();
        $citasUltimos7Dias->push(['fecha' => $fecha, 'total' => $total]);
    }

    return view('admin.dashboard', compact(
        'citasHoy', 'citasPendientes', 'totalBarberos', 'citasEsteMes',
        'citasPorEstado', 'citasPorBarbero', 'citasUltimos7Dias'
    ));
})->name('dashboard');


// Gestion de roles
Route::resource('roles', RoleController::class);

// Gestion de usuarios
Route::resource('users', UserController::class);

// Gestion de barberos
Route::resource('barbers', BarberController::class);

// Gestion de servicios
Route::resource('services', ServiceController::class);

// Gestion de horarios
Route::resource('schedules', ScheduleController::class);

// Gestion de citas
Route::get('appointments/pdf', [AppointmentController::class, 'pdf'])->name('appointments.pdf');
Route::resource('appointments', AppointmentController::class);
