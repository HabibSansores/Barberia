<?php

use App\Console\Commands\EnviarRecordatoriosCitas;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Comando de ejemplo de Laravel (no eliminar)
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// ── TASK SCHEDULING ──────────────────────────────────────────────────────────
// Envía recordatorios de citas automáticamente todos los días a las 8:00 AM.
// Los clientes con citas programadas para el día siguiente recibirán un correo.
Schedule::command(EnviarRecordatoriosCitas::class)
    ->dailyAt('08:00')
    ->timezone('America/Merida')
    ->withoutOverlapping()
    ->runInBackground()
    ->appendOutputTo(storage_path('logs/recordatorios-citas.log'));

