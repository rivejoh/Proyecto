<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;

Route::resource('medicamentos', MedicineController::class); // ruta para el controlador de medicamentos, con todas las rutas RESTful (index, create, store, show, edit, update, destroy)
