<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UserMedicineController;
use App\Http\Middleware\EnsureAdmin;
use App\Http\Middleware\EnsureUser;


Route::view('/', 'welcome')->name('home');

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        return $user?->is_admin
            ? redirect()->route('admin.dashboard')
            : redirect()->route('dashboard');
    }

    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard usuario 
    Route::middleware([EnsureUser::class])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
    });
    // Dashboard administrador
    Route::middleware([EnsureAdmin::class])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])
            ->name('admin.dashboard');
        Route::get('/admin/horario', [AdminController::class, 'horario'])
            ->name('admin.horario');
    });

    Route::resource('user-medicines', UserMedicineController::class)->except(['show'])->names('user.medicamentos');
    Route::get('user-medicines-agendar/{medicamento}',[UserMedicineController::class, 'create'])->name('user.medicamentos.agenda');
    Route::get('agenda', [AgendaController::class, 'index'])->name('agenda.index');

    Route::get('/agenda/create/{medicamento}', [AgendaController::class, 'create'])->name('agenda.create');
    Route::post('/agenda/store', [AgendaController::class, 'store'])
        ->name('agenda.store');

    Route::get('horario', [HorarioController::class, 'index'])->name('horario');

    Route::get('manana', [HorarioController::class, 'manana'])->name('manana');

    Route::get('tarde', [HorarioController::class, 'tarde'])->name('tarde');

    Route::get('noche', [HorarioController::class, 'noche'])->name('noche');

    Route::view('historial', 'historial')->name('historial');
    Route::view('nosotros', 'nosotros')->name('nosotros');
});

require __DIR__.'/auth.php';
