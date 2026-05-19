<?php

namespace App\Http\Controllers\Barber;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $today = Carbon::today();

        $appointmentsToday = Appointment::with(['client', 'service'])
            ->where('barber_id', $user->id)
            ->whereDate('appointment_date', $today)
            ->orderBy('start_time', 'asc')
            ->get();

        $completedToday = $appointmentsToday->where('status', 'completed')->count();
        $pendingToday = $appointmentsToday->where('status', 'pending')->count();
        
        // Citas futuras (del día) que aún no están completadas o canceladas
        $upcomingAppointments = $appointmentsToday->whereIn('status', ['pending', 'confirmed']);

        return view('barber.dashboard', compact(
            'appointmentsToday',
            'completedToday',
            'pendingToday',
            'upcomingAppointments'
        ));
    }
}
