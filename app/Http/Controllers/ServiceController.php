<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Almacena un nuevo servicio en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:150', // Límite de 150 caracteres solicitado
            'price' => 'required|numeric|min:0',
        ]);

        Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'duration_minutes' => 30, // Valor predeterminado
        ]);

        return redirect()->back()->with('service_success', 'El servicio ha sido creado con éxito.');
    }

    /**
     * Actualiza el servicio especificado en la base de datos.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:150', // Límite de 150 caracteres
            'price' => 'required|numeric|min:0',
        ]);

        $service->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('service_success', 'El servicio ha sido actualizado con éxito.');
    }

    /**
     * Elimina el servicio especificado de la base de datos.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->back()->with('service_success', 'El servicio ha sido eliminado con éxito.');
    }
}
