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

        // Buscar IDs de relaciones de forma dinámica para la normalización híbrida
        $clienteId = auth()->check() ? auth()->id() : (\App\Models\User::where('email', $request->email)->first()?->id);
        $barberId = \App\Models\User::role('Barbero')->where('name', $request->barbero)->first()?->id;
        $serviceId = \App\Models\Service::where('name', $request->servicio)->first()?->id;

        $cita = \App\Models\Cita::create([
            'cliente_id' => $clienteId,
            'barber_id' => $barberId,
            'service_id' => $serviceId,
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

        // 2. Enviar correo electrónico de confirmación con PDF al cliente y al barbero
        $emailStatus = '';
        try {
            // Generar PDF usando laravel-dompdf
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('emails.cita_pdf', compact('cita'));
            $pdfData = $pdf->output();

            // Notificar al Cliente si proporcionó correo
            if ($cita->email) {
                try {
                    \Illuminate\Support\Facades\Mail::to($cita->email)->send(new \App\Mail\CitaConfirmationMail($cita, $pdfData));
                    $emailStatus = ' y correo de confirmación enviado al cliente';
                } catch (\Exception $clientMailException) {
                    \Illuminate\Support\Facades\Log::error('Error al enviar correo de confirmación al cliente: ' . $clientMailException->getMessage());
                    $emailStatus = ' (error al enviar correo al cliente)';
                }
            }

            // Notificar al Barbero de la nueva cita inmediatamente
            try {
                $barberUser = \App\Models\User::role('Barbero')
                    ->where('name', $cita->barbero)
                    ->first();
                if ($barberUser) {
                    \Illuminate\Support\Facades\Mail::to($barberUser->email)->send(new \App\Mail\BarberNewAppointmentMail($cita, $barberUser, $pdfData));
                    if ($emailStatus !== '') {
                        $emailStatus .= ' y al barbero';
                    } else {
                        $emailStatus = ' y notificación enviada al barbero';
                    }
                }
            } catch (\Exception $barberMailException) {
                \Illuminate\Support\Facades\Log::error('Error al enviar correo de confirmación al barbero: ' . $barberMailException->getMessage());
            }

        } catch (\Exception $pdfException) {
            \Illuminate\Support\Facades\Log::error('Error al generar PDF o procesar correos de la cita: ' . $pdfException->getMessage());
            $emailStatus = ' (error al procesar confirmación por correo)';
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

        // Obtener las horas ya ocupadas para esta fecha (excluyendo citas canceladas)
        $bookedSlots = \App\Models\Cita::where('fecha', $fecha)
            ->whereNotIn('estado', ['cancelada', 'Cancelada'])
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

    public function completar(\App\Models\Cita $cita)
    {
        $cita->update(['estado' => 'completada']);
        return redirect()->back()->with('success', 'La cita ha sido marcada como COMPLETADA.');
    }

    public function cancelar(Request $request, \App\Models\Cita $cita)
    {
        $request->validate([
            'motivo_cancelacion' => 'required|string',
            'otro_motivo' => 'nullable|string'
        ]);

        $motivo = $request->motivo_cancelacion;
        if ($motivo === 'otro') {
            $request->validate([
                'otro_motivo' => 'required|string|min:10|max:500'
            ]);
            $motivo = $request->otro_motivo;
        }

        $cita->update([
            'estado' => 'cancelada',
            'motivo_cancelacion' => $motivo
        ]);

        return redirect()->back()->with('success', 'La cita ha sido CANCELADA correctamente.');
    }

    public function reagendar(Request $request, \App\Models\Cita $cita)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required'
        ]);

        // Si se reagenda para hoy, validar que el horario no haya pasado
        $today = \Carbon\Carbon::now('America/Mexico_City')->toDateString();
        if ($request->fecha === $today) {
            $currentHour = \Carbon\Carbon::now('America/Mexico_City')->format('H:i');
            $selectedHour = date('H:i', strtotime($request->hora));
            $dayOfWeek = date('w', strtotime($request->fecha));
            $lastHour = ($dayOfWeek == 6) ? '17:00' : '19:00';

            if ($currentHour >= $lastHour || $selectedHour <= $currentHour) {
                return redirect()->back()->with('error_msg', 'El día de trabajo de la barbería de hoy es de 9am a 7pm. Ese horario ya pasó por el día de hoy. Intente reagendar para otro momento.');
            }
        }

        $cita->update([
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => 'Confirmada'
        ]);

        return redirect()->back()->with('success', 'La cita ha sido REAGENDADA con éxito.');
    }
}
