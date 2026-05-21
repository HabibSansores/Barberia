<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.services.index');
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        $data['duration_minutes'] = 30; // Valor por defecto ya que no es relevante
        $data['image_path'] = null;

        Service::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Servicio creado',
            'text' => 'El servicio se ha creado correctamente',
        ]);

        return redirect(route('admin.services.index'));
    }

    public function show(Service $service)
    {
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        $data['duration_minutes'] = 30; // Valor por defecto ya que no es relevante

        $service->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Servicio actualizado',
            'text' => 'El servicio ha sido actualizado correctamente',
        ]);

        return redirect()->route('admin.services.edit', $service);
    }

    public function destroy(Service $service)
    {
        if ($service->image_path) {
            Storage::disk('public')->delete($service->image_path);
        }
        
        $service->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Servicio eliminado',
            'text' => 'El servicio ha sido eliminado correctamente',
        ]);

        return redirect(route('admin.services.index'));
    }
}
