<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $medicines = Medicamento::where('active', 1)
        ->get();


        $events = [];

        foreach ($medicines as $medicine) {
            $scheduleTime = $medicine->schedule_time instanceof Carbon
                ? $medicine->schedule_time->format('H:i:s')
                : trim($medicine->schedule_time);
            
        
            $events[] = [
                'title' => $medicine->name,
                'start' => now()->format('Y-m-d') . 'T' . $scheduleTime,
                'extendedProps' => [
                    'dosage' => $medicine->dosage,
                    'frequency' => $medicine->frequency,
                    'instructions' => $medicine->instructions,
                ],
            ];
        }

        // // Añadir evento temporal desde sesión si existe (guardado con fecha específica)
        // if (session()->has('temp_event')) {
        //     $temp = session('temp_event');
        //     if (is_array($temp)) {
        //         $events[] = $temp;
        //     }
        // }

        return view('agenda.index', compact('events'));
    }


    public function create(Medicamento $medicamento)
    {
         return view('agenda.create', ['medicamento' => $medicamento
    ]);

    }

    public function store(Request $request)
    {
        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'schedule_time' => 'nullable|date_format:H:i',
            'start_time' => 'nullable|date_format:H:i',
            'start_date' => 'nullable|date',
            'instructions' => 'nullable|string',
            // alternativas usadas en otras vistas
            'fecha' => 'nullable|date',
            'hora' => 'nullable|date_format:H:i',
        ]);

        $medicine = Medicamento::findOrFail($request->medicamento_id);

        if ($medicine->user_id !== Auth::id()) {
            abort(403);
        }

        // Normalizar hora: aceptar schedule_time, start_time o hora
        $timeInput = $request->input('schedule_time') ?? $request->input('start_time') ?? $request->input('hora');
        $time = null;

        if ($timeInput) {
            try {
                $time = Carbon::createFromFormat('H:i', $timeInput)->format('H:i:s');
            } catch (\Exception $e) {
                // intentar sin formato y limpiar
                $time = trim($timeInput);
            }
        }

        if ($time) {
            $medicine->schedule_time = $time;
        }

        if ($request->filled('instructions')) {
            $medicine->instructions = $request->instructions;
        }

        $medicine->active = true;
        $medicine->save();

        // Si se envió una fecha específica, crear un evento temporal en sesión para mostrarlo inmediatamente
        $dateInput = $request->input('start_date') ?? $request->input('fecha');
        if ($dateInput && $time) {
            $eventStart = $dateInput . 'T' . (strlen($time) === 5 ? $time . ':00' : $time);
            $tempEvent = [
                'title' => $medicine->name,
                'start' => $eventStart,
                'extendedProps' => [
                    'dosage' => $medicine->dosage,
                    'frequency' => $medicine->frequency,
                    'instructions' => $medicine->instructions,
                ],
            ];

            session()->flash('temp_event', $tempEvent);
        }

        return redirect()
            ->route('agenda.index')
            ->with('success', 'Medicamento agregado al calendario correctamente.');
    }

}
