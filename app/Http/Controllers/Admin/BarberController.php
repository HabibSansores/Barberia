<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class BarberController extends Controller
{
    public function index()
    {
        return view('admin.barbers.index');
    }

    public function create()
    {
        return view('admin.barbers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'id_number' => 'required|string|min:5|max:20|regex:/^[A-Za-z0-9]+$/|unique:users',
            'phone' => 'required|digits_between:7,15',
            'address' => 'required|string|max:255',
        ]);

        $user = User::create($data);

        // Asignar rol de Barbero
        $role = Role::where('name', 'Barbero')->first();
        if ($role) {
            $user->roles()->attach($role->id);
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Barbero creado correctamente',
            'text' => 'El barbero se ha creado correctamente',
        ]);

        return redirect(route('admin.barbers.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $barber = User::findOrFail($id);
        return view('admin.barbers.edit', compact('barber'));
    }

    public function update(Request $request, $id)
    {
        $barber = User::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $barber->id,
            'id_number' => 'required|string|min:5|max:20|regex:/^[A-Za-z0-9]+$/|unique:users,id_number,'. $barber->id,
            'phone' => 'required|digits_between:7,15',
            'address' => 'required|string|max:255',
        ]);

        $barber->update($data);

        if ($request->filled('password')) {
            $barber->password = bcrypt($request->password);
            $barber->save();
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Barbero actualizado',
            'text' => 'El barbero ha sido actualizado correctamente',
        ]);

        return redirect()->route('admin.barbers.edit', $barber->id);
    }

    public function destroy($id)
    {
        $barber = User::findOrFail($id);
        $barber->delete(); // Soft delete enabled

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Barbero eliminado',
            'text' => 'El barbero ha sido eliminado correctamente',
        ]);

        return redirect(route('admin.barbers.index'));
    }
}
