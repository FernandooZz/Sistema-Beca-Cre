<?php

use App\Http\Controllers\EstudianteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
});

Route::get('/buscar-estudiantes', [EstudianteController::class, 'buscar'])
    ->name('estudiantes.buscar');
