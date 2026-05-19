<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('admin.appointments.index');
    }

    public function create()
    {
        // Typically appointments are created by clients, but admin can do it too.
        // For simplicity we will only list and manage status for now.
    }

    public function store(Request $request)
    {
    }

    public function show(Appointment $appointment)
    {
    }

    public function edit(Appointment $appointment)
    {
    }

    public function update(Request $request, Appointment $appointment)
    {
        // Admin solo actualiza estado
        $data = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Estado actualizado',
            'text' => 'El estado de la cita ha sido actualizado',
        ]);

        return back();
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Cita eliminada',
            'text' => 'La cita ha sido eliminada',
        ]);

        return back();
    }

    public function pdf()
    {
        $appointments = Appointment::with(['client', 'barber', 'service'])
            ->orderBy('appointment_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();
            
        $pdf = Pdf::loadView('admin.appointments.pdf', compact('appointments'));
        return $pdf->download('reporte-citas.pdf');
    }
}
