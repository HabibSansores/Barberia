<?php

use App\Console\Commands\EnviarRecordatoriosCitas;
use App\Console\Commands\EnviarReportesDiarios;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Comando de ejemplo de Laravel (no eliminar)
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// ── TASK SCHEDULING ──────────────────────────────────────────────────────────

// 1. Envía recordatorios a los clientes 24 horas antes de su cita (se ejecuta cada hora)
Schedule::command(EnviarRecordatoriosCitas::class)
    ->hourly()
    ->timezone('America/Merida')
    ->withoutOverlapping()
    ->runInBackground()
    ->appendOutputTo(storage_path('logs/recordatorios-citas.log'));

// 2. Envía la agenda diaria en PDF a barberos y admins todos los días a las 7:00 AM
Schedule::command(EnviarReportesDiarios::class)
    ->dailyAt('16:03')
    ->timezone('America/Merida')
    ->withoutOverlapping()
    ->runInBackground()
    ->appendOutputTo(storage_path('logs/reportes-diarios.log'));

