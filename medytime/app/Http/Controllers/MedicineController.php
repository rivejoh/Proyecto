<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicamento::with('user')
            ->orderBy('user_id')
            ->orderBy('schedule_time')
            ->get();

        return view('admin.medicamentos.index', compact('medicines'));
    }

    public function create()
    {
        return view('admin.medicamentos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dosage' => ['required', 'string', 'max:255'],
            'frequency' => ['required', 'string', 'max:255'],
            'schedule_time' => ['required', 'date_format:H:i'],
            'instructions' => ['nullable', 'string'],
            'active' => ['nullable', 'boolean'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $validated['active'] = $request->has('active');

        Medicamento::create($validated);

        return redirect()->route('admin.medicamentos.index')->with('success', 'Medicamento guardado correctamente.');
    }

    public function edit(Medicamento $medicine)
    {
        $users = User::all();
        return view('admin.medicamentos.edit', compact('medicine', 'users'));
    }

    public function update(Request $request, Medicamento $medicine)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dosage' => ['required', 'string', 'max:255'],
            'frequency' => ['required', 'string', 'max:255'],
            'schedule_time' => ['required', 'date_format:H:i'],
            'instructions' => ['nullable', 'string'],
            'active' => ['nullable', 'boolean'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $validated['active'] = $request->has('active');
        $medicine->update($validated);

        return redirect()->route('admin.medicamentos.index')->with('success', 'Medicamento actualizado correctamente.');
    }

    public function destroy(Medicamento $medicine)
    {
        $medicine->delete();

        return redirect()->route('admin.medicamentos.index')->with('success', 'Medicamento eliminado correctamente.');
    }
}
