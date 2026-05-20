<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barbero;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Muestra la vista de selección de rol.
     */
    public function showSelect()
    {
        return view('auth.select');
    }

    /**
     * Muestra el formulario de registro de Cliente.
     */
    public function showClienteForm()
    {
        return view('auth.register-cliente');
    }

    /**
     * Muestra el formulario de registro de Barbero.
     */
    public function showBarberoForm()
    {
        return view('auth.register-barbero');
    }

    /**
     * Procesa el registro de un Cliente.
     */
    public function registerCliente(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear el registro de usuario común
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptación con bcrypt
            'phone' => $request->telefono,
            'id_number' => '', // Campo nullable
            'address' => '',    // Campo nullable
        ]);

        // Asignar rol de Spatie
        $user->assignRole('Cliente');

        // Registrar en la tabla clientes
        Cliente::create([
            'user_id' => $user->id,
        ]);

        // Iniciar sesión automáticamente
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    /**
     * Procesa el registro de un Barbero.
     */
    public function registerBarbero(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear el registro de usuario común
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptación con bcrypt
            'phone' => $request->telefono,
            'id_number' => '', // Campo nullable
            'address' => '',    // Campo nullable
        ]);

        // Asignar rol de Spatie
        $user->assignRole('Barbero');

        // Registrar en la tabla de barberos con su especialidad
        Barbero::create([
            'user_id' => $user->id,
            'especialidad' => $request->especialidad,
        ]);

        // Iniciar sesión automáticamente
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
