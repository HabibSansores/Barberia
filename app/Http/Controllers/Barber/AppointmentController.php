<?php

namespace App\Http\Controllers\Barber;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function show(Request $request, Appointment $appointment)
    {
        // Verificar que la cita le pertenezca al barbero
        if ($appointment->barber_id !== $request->user()->id) {
            abort(403, 'No tienes permiso para ver esta cita.');
        }

        $appointment->load(['client', 'service']);
        return view('barber.appointments.show', compact('appointment'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        if ($appointment->barber_id !== $request->user()->id) {
            abort(403);
        }

        $data = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->update(['status' => $data['status']]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Estado actualizado',
            'text' => 'El estado de la cita ha sido actualizado.',
        ]);

        return back();
    }
}
