<?php

namespace App\Console\Commands;

use App\Mail\BarberoDailyAppointmentsMail;
use App\Mail\AdminDailyAppointmentsMail;
use App\Models\Cita;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EnviarReportesDiarios extends Command
{
    /**
     * El nombre y firma del comando Artisan.
     */
    protected $signature = 'citas:reportes-diarios';

    /**
     * Descripción del comando.
     */
    protected $description = 'Envía resúmenes diarios en PDF con la agenda del día a barberos y administradores';

    /**
     * Ejecutar el comando.
     */
    public function handle(): int
    {
        $hoy = Carbon::now('America/Merida')->toDateString();

        $this->info("🔍 Procesando reportes diarios de agenda:");
        $this->info("📅 Fecha de Hoy (Reportes diarios): {$hoy}");

        // ==================== 1. RESUMEN DIARIO A BARBEROS (CITAS DE HOY) ====================
        $barberos = User::role('Barbero')->get();
        $enviadosBarberos = 0;
        $erroresBarberos  = 0;

        foreach ($barberos as $barbero) {
            // Obtener citas del barbero para hoy que no estén canceladas
            $citasBarbero = Cita::whereDate('fecha', $hoy)
                ->where('barbero', $barbero->name)
                ->whereNotIn('estado', ['cancelada', 'Cancelada'])
                ->get();

            $pdfData = null;

            if ($citasBarbero->isNotEmpty()) {
                try {
                    // Generar PDF usando laravel-dompdf
                    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('emails.barbero_daily_summary_pdf', [
                        'barbero' => $barbero,
                        'citas' => $citasBarbero
                      ]);
                    $pdfData = $pdf->output();
                    $this->info("📄 PDF de agenda diaria generado con éxito para el barbero: {$barbero->name}");
                } catch (\Exception $pdfException) {
                    $this->error("❌ Error generando PDF para barbero {$barbero->name}: " . $pdfException->getMessage());
                    Log::error("Error generating daily summary PDF for barber {$barbero->name}: " . $pdfException->getMessage());
                }
            }

            try {
                // Enviar Mail al Barbero (con o sin PDF adjunto dependiendo de si tiene citas)
                Mail::to($barbero->email)->send(new BarberoDailyAppointmentsMail($barbero, $citasBarbero, $pdfData));
                $this->info("📧 Agenda diaria enviada al barbero: {$barbero->email}");
                $enviadosBarberos++;
            } catch (\Exception $e) {
                $this->error("❌ Error enviando agenda a barbero {$barbero->email}: " . $e->getMessage());
                Log::error("Error enviando agenda diaria a barbero {$barbero->name}: " . $e->getMessage());
                $erroresBarberos++;
            }
        }

        // ==================== 2. RESUMEN DIARIO CONSOLIDADO A ADMINISTRADORES (TODAS LAS CITAS DE HOY) ====================
        $admins = User::role('Administrador')->get();
        $citasHoyGeneral = Cita::whereDate('fecha', $hoy)
            ->whereNotIn('estado', ['cancelada', 'Cancelada'])
            ->get();

        $enviadosAdmins = 0;
        $erroresAdmins  = 0;

        foreach ($admins as $admin) {
            $pdfGeneralData = null;

            if ($citasHoyGeneral->isNotEmpty()) {
                try {
                    // Generar PDF Consolidado usando laravel-dompdf
                    $pdfGeneral = \Barryvdh\DomPDF\Facade\Pdf::loadView('emails.admin_daily_summary_pdf', [
                        'admin' => $admin,
                        'citas' => $citasHoyGeneral
                    ]);
                    $pdfGeneralData = $pdfGeneral->output();
                    $this->info("📄 PDF general consolidado generado con éxito para el administrador: {$admin->name}");
                } catch (\Exception $pdfGeneralException) {
                    $this->error("❌ Error generando PDF general para administrador {$admin->name}: " . $pdfGeneralException->getMessage());
                    Log::error("Error generating general daily summary PDF for admin {$admin->name}: " . $pdfGeneralException->getMessage());
                }
            }

            try {
                // Enviar Mail al Administrador (con o sin PDF consolidado)
                Mail::to($admin->email)->send(new AdminDailyAppointmentsMail($admin, $citasHoyGeneral, $pdfGeneralData));
                $this->info("📧 Agenda general consolidada enviada al administrador: {$admin->email}");
                $enviadosAdmins++;
            } catch (\Exception $e) {
                $this->error("❌ Error enviando agenda general a administrador {$admin->email}: " . $e->getMessage());
                Log::error("Error enviando agenda diaria consolidada a administrador {$admin->name}: " . $e->getMessage());
                $erroresAdmins++;
            }
        }

        $this->newLine();
        $this->info("=== RESUMEN DE ENVÍO DE REPORTES DIARIOS ===");
        $this->info("✅ Agendas de Barberos Enviadas (Hoy): {$enviadosBarberos} (Errores: {$erroresBarberos})");
        $this->info("✅ Agendas de Administradores Enviadas (Hoy): {$enviadosAdmins} (Errores: {$erroresAdmins})");

        return Command::SUCCESS;
    }
}
