<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function create()
    {
        return view('citas.create');
    }

    public function store(Request $request)
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

        // Validar si la cita es para hoy y el horario ya pasó
        $today = \Carbon\Carbon::now('America/Mexico_City')->toDateString();
        if ($request->fecha === $today) {
            $currentHour = \Carbon\Carbon::now('America/Mexico_City')->format('H:i');
            $selectedHour = date('H:i', strtotime($request->hora));
            $dayOfWeek = date('w', strtotime($request->fecha));
            $lastHour = ($dayOfWeek == 6) ? '17:00' : '19:00';

            if ($currentHour >= $lastHour || $selectedHour <= $currentHour) {
                return redirect()->back()->withInput()->with([
                    'error_msg' => 'El día de trabajo de la barbería de hoy es de 9am a 7pm. Ese horario ya pasó por el día de hoy. Intente agendar la fecha para el día de mañana.'
                ]);
            }
        }

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

        // 1. Generar enlace de WhatsApp (Click to Chat)
        $mensaje = "Hola {$cita->nombre_cliente}, tu cita para {$cita->servicio} con {$cita->barbero} el {$cita->fecha} a las {$cita->hora} ha sido registrada exitosamente en la Barbería. ¡Te esperamos!";
        
        $phone = preg_replace('/[^0-9]/', '', $cita->telefono);
        if (strlen($phone) === 10) {
            $phone = '521' . $phone; // Asumir prefijo de México si tiene 10 dígitos
        }
        $whatsappUrl = "https://wa.me/{$phone}?text=" . urlencode($mensaje);

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

        return redirect()->back()->with([
            'success' => 'Cita registrada con éxito' . $emailStatus . '.',
            'whatsapp_url' => $whatsappUrl
        ]);
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
        if ($dayOfWeek == 6) { // Sábado: 10:00 a 17:00
            $totalSlots = ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];
        } else { // Lunes a Viernes: 09:00 a 19:00
            $totalSlots = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00'];
        }

        // Si el usuario selecciona "hoy", filtramos horas pasadas
        $today = \Carbon\Carbon::now('America/Mexico_City')->toDateString();
        if ($fecha === $today) {
            $currentHour = \Carbon\Carbon::now('America/Mexico_City')->format('H:i');
            $lastHour = ($dayOfWeek == 6) ? '17:00' : '19:00';
            
            if ($currentHour >= $lastHour) {
                return response()->json([
                    'error' => 'El día de trabajo de la barbería de hoy es de 9am a 7pm. Ese horario ya pasó por el día de hoy. Intente agendar la fecha para el día de mañana.'
                ]);
            }
            
            // Solo dejamos las horas que son estrictamente mayores que la hora actual
            $totalSlots = array_values(array_filter($totalSlots, function ($slot) use ($currentHour) {
                return $slot > $currentHour;
            }));

            // Si todos los slots de hoy ya pasaron
            if (empty($totalSlots)) {
                return response()->json([
                    'error' => 'El día de trabajo de la barbería de hoy es de 9am a 7pm. Ese horario ya pasó por el día de hoy. Intente agendar la fecha para el día de mañana.'
                ]);
            }
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

    public function buscarClienteByEmail(Request $request)
    {
        $email = $request->query('email');
        if (!$email) {
            return response()->json(['success' => false, 'message' => 'Email no proporcionado.']);
        }

        $user = \App\Models\User::where('email', $email)->first();
        if ($user) {
            return response()->json([
                'success' => true,
                'nombre' => $user->name,
                'telefono' => $user->phone
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Cliente no encontrado.']);
    }
}
