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

        if ($user->hasRole('Barbero')) {
            $barberoInfo = $user->barbero;
            $especialidad = $barberoInfo ? $barberoInfo->especialidad : 'General';
            
            // Obtener servicios de la barbería
            $services = Service::all();
            
            // Citas asignadas a este barbero para el día de hoy
            $today = date('Y-m-d');
            $citas = Cita::where('barbero', $user->name)
                         ->where('fecha', $today)
                         ->orderBy('hora', 'asc')
                         ->get();

            // Lista de todos los barberos (para el formulario de citas del propio barbero)
            $barberos = User::role('Barbero')->get();

            return view('barbero.dashboard', compact('user', 'especialidad', 'services', 'citas', 'today', 'barberos'));
        } 
        
        if ($user->hasRole('Cliente')) {
            // Servicios informativos
            $services = Service::all();
            
            // Barberos disponibles
            $barberos = User::role('Barbero')->with('barbero')->get();
            
            return view('cliente.dashboard', compact('user', 'services', 'barberos'));
        }

        // Si por alguna razón es Administrador u otro rol sin vista definida, cargar panel de cliente por defecto
        $services = Service::all();
        $barberos = User::role('Barbero')->with('barbero')->get();
        
        return view('cliente.dashboard', compact('user', 'services', 'barberos'));
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
