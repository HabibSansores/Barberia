<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('admin.appointments.index');
    }

    public function update(Request $request, Cita $appointment)
    {
        $data = $request->validate([
            'estado' => 'required|in:Pendiente,Confirmada,completada,Cancelada',
        ]);

        $appointment->update($data);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Estado actualizado',
            'text'  => 'El estado de la cita ha sido actualizado correctamente.',
        ]);

        return back();
    }

    public function destroy(Cita $appointment)
    {
        $appointment->delete(); // SoftDelete

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Cita eliminada',
            'text'  => 'La cita ha sido eliminada del sistema.',
        ]);

        return back();
    }

    public function pdf()
    {
        $appointments = Cita::orderBy('fecha', 'asc')
            ->orderBy('hora', 'asc')
            ->get();

        $pdf = Pdf::loadView('admin.appointments.pdf', compact('appointments'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('reporte-citas-' . now()->format('Y-m-d') . '.pdf');
    }
}
