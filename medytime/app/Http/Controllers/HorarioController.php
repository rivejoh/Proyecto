<?php

namespace App\Http\Controllers;
use App\Models\Medicamento;
use App\Models\Medicine;

class HorarioController extends Controller
{
    public function index()
    {
        return view('horarios.horario');
    }

    public function manana()
    {
        $medicamentos = Medicamento::where('active', 1)
            ->where(function ($query) {
                $query->whereTime('schedule_time', '>=', '06:00:00')
                      ->whereTime('schedule_time', '<', '12:00:00')
                      ->orWhere('frequency', 'like', '%12%');
            })
            ->orderBy('schedule_time')
            ->get();

        return view('horarios.manana', compact('medicamentos'));
    }

    public function tarde()
    {
        $medicamentos = Medicamento::where('active', 1)
            ->where(function ($query) {
                $query->whereTime('schedule_time', '>=', '12:00:00')
                      ->whereTime('schedule_time', '<', '18:00:00');
            })
            ->orderBy('schedule_time')
            ->get();

        return view('horarios.tarde', compact('medicamentos'));
    }

    public function noche()
    {
        $medicamentos = Medicamento::where('active', 1)
            ->where(function ($query) {
                $query->whereTime('schedule_time', '>=', '18:00:00')
                      ->orWhere('frequency', 'like', '%12%');
            })
            ->orderBy('schedule_time')
            ->get();

        return view('horarios.noche', compact('medicamentos'));
    }
}