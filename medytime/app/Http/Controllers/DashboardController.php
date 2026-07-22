<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $medicines = Medicamento::where('user_id', Auth::id())
            ->orderBy('schedule_time')
            ->get();
            

        $nextReminders = Medicamento::where('user_id', Auth::id())
            ->where('active', true)
            ->whereTime('schedule_time', '>=', Carbon::now()->format('H:i:s'))
            ->orderBy('schedule_time')
            ->limit(5)
            ->get();

        return view('user.dashboard', compact('medicines', 'nextReminders'));
    }
}
