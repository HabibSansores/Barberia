<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('admin.schedules.index');
    }

    public function create()
    {
        $barbers = User::role('Barbero')->get();
        return view('admin.schedules.create', compact('barbers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'day_of_week' => 'required|integer|min:0|max:6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_working' => 'boolean',
        ]);

        $data['is_working'] = $request->has('is_working');

        Schedule::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Horario creado',
            'text' => 'El horario se ha creado correctamente',
        ]);

        return redirect(route('admin.schedules.index'));
    }

    public function show(Schedule $schedule)
    {
    }

    public function edit(Schedule $schedule)
    {
        $barbers = User::role('Barbero')->get();
        return view('admin.schedules.edit', compact('schedule', 'barbers'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'day_of_week' => 'required|integer|min:0|max:6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_working' => 'boolean',
        ]);

        $data['is_working'] = $request->has('is_working');

        $schedule->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Horario actualizado',
            'text' => 'El horario ha sido actualizado correctamente',
        ]);

        return redirect()->route('admin.schedules.edit', $schedule);
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Horario eliminado',
            'text' => 'El horario ha sido eliminado correctamente',
        ]);

        return redirect(route('admin.schedules.index'));
    }
}
