<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * Carga el panel correspondiente según el rol del usuario autenticado.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Administrador')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('Barbero')) {
            $barberoInfo = $user->barbero;
            $especialidad = $barberoInfo ? $barberoInfo->especialidad : 'General';

            $services = Service::all();

            // Citas de hoy para el barbero
            $today = date('Y-m-d');
            $citas = Cita::where('barbero', $user->name)
                         ->where('fecha', $today)
                         ->orderBy('hora', 'asc')
                         ->get();

            // HISTORIAL: todas las citas del barbero
            $todasLasCitas = Cita::where('barbero', $user->name)
                                 ->orderByDesc('fecha')
                                 ->orderByDesc('hora')
                                 ->get();

            $barberos = User::role('Barbero')->get();

            return view('barbero.dashboard', compact(
                'user', 'especialidad', 'services', 'citas', 'today', 'barberos', 'todasLasCitas'
            ));
        } 
        
        if ($user->roles()->count() === 0) {
            $user->assignRole('Cliente');
        }
        
        if ($user->hasRole('Cliente')) {
            $services = Service::all();
            $barberos = User::role('Barbero')->with('barbero')->get();

            // Historial de citas del cliente (por email o nombre)
            $misCitas = Cita::where('email', $user->email)
                            ->orWhere('nombre_cliente', $user->name)
                            ->orderByDesc('fecha')
                            ->orderByDesc('hora')
                            ->get();

            // Resumen rápido
            $citasActivas    = $misCitas->whereIn('estado', ['Pendiente', 'pendiente', 'Confirmada', 'confirmada']);
            $citasCanceladas = $misCitas->whereIn('estado', ['Cancelada', 'cancelada']);
            $citasCompletadas = $misCitas->where('estado', 'completada');

            return view('cliente.dashboard', compact(
                'user', 'services', 'barberos',
                'misCitas', 'citasActivas', 'citasCanceladas', 'citasCompletadas'
            ));
        }

        // Si por alguna razón no tiene vista definida, cargar panel de cliente por defecto con todas las variables necesarias
        $services = Service::all();
        $barberos = User::role('Barbero')->with('barbero')->get();
        $misCitas = Cita::where('email', $user->email)
                        ->orWhere('nombre_cliente', $user->name)
                        ->orderByDesc('fecha')
                        ->orderByDesc('hora')
                        ->get();
        $citasActivas    = $misCitas->whereIn('estado', ['Pendiente', 'pendiente', 'Confirmada', 'confirmada']);
        $citasCanceladas = $misCitas->whereIn('estado', ['Cancelada', 'cancelada']);
        $citasCompletadas = $misCitas->where('estado', 'completada');
        
        return view('cliente.dashboard', compact(
            'user', 'services', 'barberos',
            'misCitas', 'citasActivas', 'citasCanceladas', 'citasCompletadas'
        ));
    }

    /**
     * Retorna las citas de un barbero para una fecha específica en formato JSON (para AJAX).
     */
    public function getCitasByFecha(Request $request)
    {
        $fecha = $request->query('fecha');
        if (!$fecha) {
            return response()->json([]);
        }

        $user = Auth::user();
        $citas = Cita::where('barbero', $user->name)
                     ->where('fecha', $fecha)
                     ->orderBy('hora', 'asc')
                     ->get();

        return response()->json($citas);
    }

    /**
     * Actualiza la información del perfil del usuario autenticado.
     */
    public function updatePerfil(Request $request)
    {
        $user = Auth::user();
        
        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ];

        if ($user->hasRole('Barbero')) {
            $rules['especialidad'] = 'required|string|max:255';
        }

        $request->validate($rules);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if ($user->hasRole('Barbero')) {
            $barbero = $user->barbero;
            if (!$barbero) {
                $barbero = new \App\Models\Barbero();
                $barbero->user_id = $user->id;
            }
            $barbero->especialidad = $request->especialidad;
            $barbero->save();
        }

        return redirect()->back()->with('success', 'Perfil actualizado con éxito.');
    }
}
