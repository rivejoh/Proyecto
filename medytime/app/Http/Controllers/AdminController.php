<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::withCount('medicamentos')
            ->orderBy('name')
            ->get();

        $totalUsers = $users->count();
        $totalMedicamentos = Medicamento::count();
        $activeMedicamentos = Medicamento::where('active', true)->count();

        return view('admin.dashboard', compact('users', 'totalUsers', 'totalMedicamentos', 'activeMedicamentos'));
    }

    public function horario()
    {
        $medicamentos = Medicamento::with('user')
            ->orderBy('schedule_time')
            ->get();

        return view('admin.horario', compact('medicamentos'));
    }
}
