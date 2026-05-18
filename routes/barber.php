<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Barber\DashboardController;
use App\Http\Controllers\Barber\CalendarController;
use App\Http\Controllers\Barber\AppointmentController;
use App\Livewire\Barber\Datatables\HistoryTable;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Calendario y API para FullCalendar
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
Route::get('/calendar/events', [CalendarController::class, 'events'])->name('calendar.events');

// Gestión de Citas
Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
Route::put('/appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');

// Historial
Route::get('/history', function() {
    return view('barber.history');
})->name('history');
