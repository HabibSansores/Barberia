<?php

namespace App\Http\Controllers\Barber;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return view('barber.calendar');
    }

    public function events(Request $request)
    {
        $user = $request->user();
        
        $start = $request->query('start');
        $end = $request->query('end');

        $query = Appointment::with(['client', 'service'])
            ->where('barber_id', $user->id);

        if ($start) {
            $query->where('appointment_date', '>=', date('Y-m-d', strtotime($start)));
        }
        if ($end) {
            $query->where('appointment_date', '<=', date('Y-m-d', strtotime($end)));
        }

        $appointments = $query->get();

        $events = $appointments->map(function ($appointment) {
            $title = ($appointment->client->name ?? 'Cliente') . ' - ' . ($appointment->service->name ?? 'Servicio');
            
            $color = '#3b82f6'; // blue default (pending)
            if ($appointment->status === 'completed') $color = '#22c55e'; // green
            if ($appointment->status === 'cancelled') $color = '#ef4444'; // red
            if ($appointment->status === 'confirmed') $color = '#a855f7'; // purple

            return [
                'id' => $appointment->id,
                'title' => $title,
                'start' => $appointment->appointment_date . 'T' . $appointment->start_time,
                'end' => $appointment->appointment_date . 'T' . $appointment->end_time,
                'color' => $color,
                'url' => route('barber.appointments.show', $appointment->id)
            ];
        });

        return response()->json($events);
    }
}
