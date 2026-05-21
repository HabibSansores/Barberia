<?php

namespace App\Console\Commands;

use App\Mail\CitaReminderMail;
use App\Models\Cita;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EnviarRecordatoriosCitas extends Command
{
    /**
     * El nombre y firma del comando Artisan.
     */
    protected $signature = 'citas:recordatorios';

    /**
     * Descripción del comando.
     */
    protected $description = 'Envía recordatorios por correo a los clientes con citas programadas para mañana';

    /**
     * Ejecutar el comando.
     */
    public function handle(): int
    {
        $manana = Carbon::tomorrow()->toDateString();

        $this->info("🔍 Buscando citas para el día: {$manana}");

        // Buscar citas del día siguiente que tengan email y no estén eliminadas
        $citas = Cita::whereDate('fecha', $manana)
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->whereNotIn('estado', ['cancelada', 'Cancelada'])
            ->get();

        if ($citas->isEmpty()) {
            $this->info('✅ No hay citas con email para mañana. No se enviaron recordatorios.');
            return Command::SUCCESS;
        }

        $enviados = 0;
        $errores  = 0;

        foreach ($citas as $cita) {
            try {
                Mail::to($cita->email)->send(new CitaReminderMail($cita));
                $this->info("📧 Recordatorio enviado a: {$cita->email} ({$cita->nombre_cliente})");
                $enviados++;
            } catch (\Exception $e) {
                $this->error("❌ Error enviando a {$cita->email}: " . $e->getMessage());
                Log::error("Error en recordatorio de cita ID {$cita->id}: " . $e->getMessage());
                $errores++;
            }
        }

        $this->newLine();
        $this->info("✅ Recordatorios enviados: {$enviados}");

        if ($errores > 0) {
            $this->warn("⚠️  Errores: {$errores}");
        }

        return Command::SUCCESS;
    }
}
