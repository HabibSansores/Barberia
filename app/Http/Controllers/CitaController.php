<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function create()
    {
        return view('citas.create');
    }

    public function store(Request $request, \App\Services\GreenApiService $greenApi)
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'servicio' => 'required|string|max:255',
            'barbero' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        $cita = \App\Models\Cita::create([
            'nombre_cliente' => $request->nombre_cliente,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'servicio' => $request->servicio,
            'barbero' => $request->barbero,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => 'Pendiente',
        ]);

        // 1. Enviar mensaje por WhatsApp (si está configurado)
        $mensaje = "Hola {$cita->nombre_cliente}, tu cita para {$cita->servicio} con {$cita->barbero} el {$cita->fecha} a las {$cita->hora} ha sido registrada exitosamente en la Barbería. ¡Te esperamos!";
        $greenApi->sendMessage($cita->telefono, $mensaje);

        // 2. Enviar correo electrónico con PDF si se proporcionó correo
        $emailStatus = '';
        if ($cita->email) {
            try {
                // Generar PDF usando laravel-dompdf
                $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('emails.cita_pdf', compact('cita'));
                $pdfData = $pdf->output();

                // Enviar Mail
                \Illuminate\Support\Facades\Mail::to($cita->email)->send(new \App\Mail\CitaConfirmationMail($cita, $pdfData));
                $emailStatus = ' y correo de confirmación enviado';
            } catch (\Exception $e) {
                // Registrar el error para debuggear pero permitir que el flujo continúe
                \Illuminate\Support\Facades\Log::error('Error al enviar correo de cita: ' . $e->getMessage());
                $emailStatus = ' (error al enviar correo)';
            }
        }

        return redirect()->back()->with('success', 'Cita registrada con éxito' . $emailStatus . '.');
    }

    public function horasDisponibles(Request $request)
    {
        $fecha = $request->query('fecha');
        if (!$fecha) {
            return response()->json([]);
        }

        $dayOfWeek = date('w', strtotime($fecha)); // 0 = Domingo, 6 = Sábado, 1-5 = Lunes a Viernes

        if ($dayOfWeek == 0) { // Domingo cerrado
            return response()->json([]);
        }

        // Definir los rangos de horas
        if ($dayOfWeek == 6) { // Sábado: 10:00 a 17:00 (última cita a las 16:00 o 17:00? El usuario dijo "de 10:00 a 17:00 horas", vamos a poner hasta las 17:00)
            $totalSlots = ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];
        } else { // Lunes a Viernes: 09:00 a 19:00
            $totalSlots = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00'];
        }

        // Obtener las horas ya ocupadas para esta fecha
        $bookedSlots = \App\Models\Cita::where('fecha', $fecha)
            ->pluck('hora')
            ->map(function ($time) {
                return date('H:i', strtotime($time));
            })
            ->toArray();

        // Filtrar las horas disponibles
        $availableSlots = array_values(array_filter($totalSlots, function ($slot) use ($bookedSlots) {
            return !in_array($slot, $bookedSlots);
        }));

        return response()->json($availableSlots);
    }
}
