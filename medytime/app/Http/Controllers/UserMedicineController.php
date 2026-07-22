<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMedicineController extends Controller
{
    public function index()
    {
       $medicines = Medicamento::orderBy('schedule_time')
        ->get();
        return view('user.medicamentos.index', compact('medicines'));
    }

       public function create(Medicamento $medicamento)
    {
        return view('user.medicamentos.create', compact('medicamento'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required',
        'dosage' => 'required',
        'frequency' => 'required',
        'schedule_time' => 'required',
    ]);

        Medicamento::create([
        'name' => $request->name,
        'dosage' => $request->dosage,
        'frequency' => $request->frequency,
        'schedule_time' => $request->schedule_time,
        'instructions' => $request->instructions,
        'active' => $request->has('active'),
    ]);

    return redirect()
        ->route('agenda.index')
        ->with('success', 'Medicamento agregado al calendario correctamente');

    }

    public function edit(Medicamento $medicine)
    {
        // if ($medicine->user_id !== Auth::id()) {
        //     abort(403);
        // }

        // return view('user.medicamentos.edit', compact('medicine'));
    }

    public function update(Request $request, Medicamento $medicine)
    {
        // if ($medicine->user_id !== Auth::id()) {
        //     abort(403);
        // }

        // $validated = $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'dosage' => ['required', 'string', 'max:255'],
        //     'frequency' => ['required', 'string', 'max:255'],
        //     'schedule_time' => ['required', 'date_format:H:i'],
        //     'instructions' => ['nullable', 'string'],
        //     'active' => ['nullable', 'boolean'],
        // ]);

        // $validated['active'] = $request->has('active');
        // $medicine->update($validated);

        // return redirect()->route('user.medicamentos.index')->with('success', 'Medicamento actualizado correctamente.');
    }

    public function destroy(Medicamento $medicine)
    {
    //     if ($medicine->user_id !== Auth::id()) {
    //         abort(403);
    //     }

    //     $medicine->delete();

    //     return redirect()->route('user.medicamentos.index')->with('success', 'Medicamento eliminado correctamente.');
     }
}
