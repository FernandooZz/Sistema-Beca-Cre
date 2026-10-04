<?php

use App\Http\Controllers\EstudianteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradorController;

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

Route::post('/login', [AdministradorController::class, 'login'])
    ->name('administrador.login');

Route::post('/logout', [AdministradorController::class, 'logout'])
    ->name('administrador.logout')
    ->middleware('admin');

Route::get('/listado-estudiantes', function () {
    $estudiantes = \App\Models\Estudiante::with('carrera')
        ->whereNotNull('carrera_id')
        ->orderByDesc('fecha_registro')
        ->get();

    return view('listado-estudiantes', compact('estudiantes'));
})->middleware('admin');


Route::get('/buscar-estudiantes', [EstudianteController::class, 'buscar'])
    ->name('estudiantes.buscar');

Route::post('/registrar-estudiante', [EstudianteController::class, 'registrar'])
->name('estudiantes.registrar');
