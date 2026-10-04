<?php

use App\Http\Controllers\EstudianteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $carreras = \App\Models\Carrera::orderBy('nombre_carrera')->get();

    return view('inicio', compact('carreras'));
});

Route::get('/registro-completo', function () {
    return view('registro-completo');
});

Route::get('/tarjeta-presentacion', function () {
    $estudiante = \App\Models\Estudiante::with([
        'carrera',
        'asignacionAula',
    ])->findOrFail(request('estudiante_id'));

    return view('tarjeta-presentacion', compact('estudiante'));
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/listado-estudiantes', function () {
    return view('listado-estudiantes');
});


Route::get('/buscar-estudiantes', [EstudianteController::class, 'buscar'])
    ->name('estudiantes.buscar');

Route::post('/registrar-estudiante', [EstudianteController::class, 'registrar'])
->name('estudiantes.registrar');
