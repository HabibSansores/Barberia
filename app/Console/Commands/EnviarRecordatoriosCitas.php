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
    protected $description = 'Envía recordatorios por correo a los clientes 24 horas antes de su cita (se ejecuta cada hora)';

    /**
     * Ejecutar el comando.
     */
    public function handle(): int
    {
        $now = Carbon::now('America/Merida');
        $manana = $now->copy()->addDay()->toDateString();
        $currentHour = $now->format('H'); // Obtiene la hora actual, ej: "15"

        $this->info("🔍 Procesando recordatorios de clientes:");
        $this->info("📅 Fecha de citas a buscar (Mañana): {$manana}");
        $this->info("⏰ Hora de citas a buscar (Rango): {$currentHour}:00:00 a {$currentHour}:59:59");

        // Buscar citas de mañana que coincidan con la hora actual
        $citasClientes = Cita::whereDate('fecha', $manana)
            ->whereTime('hora', '>=', "{$currentHour}:00:00")
            ->whereTime('hora', '<=', "{$currentHour}:59:59")
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->whereNotIn('estado', ['cancelada', 'Cancelada'])
            ->get();

        $enviadosClientes = 0;
        $erroresClientes  = 0;

        foreach ($citasClientes as $cita) {
            try {
                Mail::to($cita->email)->send(new CitaReminderMail($cita));
                $this->info("📧 Recordatorio enviado al cliente: {$cita->email} ({$cita->nombre_cliente}) para su cita de mañana a las {$cita->hora}");
                $enviadosClientes++;
            } catch (\Exception $e) {
                $this->error("❌ Error enviando recordatorio a cliente {$cita->email}: " . $e->getMessage());
                Log::error("Error en recordatorio de cliente para cita ID {$cita->id}: " . $e->getMessage());
                $erroresClientes++;
            }
        }

        $this->info("=== RESUMEN DE ENVÍO DE RECORDATORIOS ===");
        $this->info("✅ Recordatorios de Clientes Enviados: {$enviadosClientes} (Errores: {$erroresClientes})");

        return Command::SUCCESS;
    }
}
