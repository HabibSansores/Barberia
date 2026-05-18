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
    $appointmentsToday = \App\Models\Appointment::whereDate('appointment_date', $today)->count();
    $incomeMonth = \App\Models\Appointment::whereMonth('appointment_date', $today->month)
        ->where('status', 'completed')
        ->sum('total_price');
    $totalBarbers = \App\Models\User::role('Barbero')->count();
    $pendingAppointments = \App\Models\Appointment::where('status', 'pending')->count();

    return view('admin.dashboard', compact('appointmentsToday', 'incomeMonth', 'totalBarbers', 'pendingAppointments'));
})->name('dashboard');

// Gestion de roles
Route::resource('roles',RoleController::class);

// Gestion de usuarios
Route::resource('users',UserController::class);

// Gestion de barberos
Route::resource('barbers', BarberController::class);

// Gestion de servicios
Route::resource('services', ServiceController::class);

// Gestion de horarios
Route::resource('schedules', ScheduleController::class);

// Gestion de citas
Route::get('appointments/pdf', [AppointmentController::class, 'pdf'])->name('appointments.pdf');
Route::resource('appointments', AppointmentController::class);