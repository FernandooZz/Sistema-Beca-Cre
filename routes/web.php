<?php

use App\Http\Controllers\EstudianteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
});

Route::get('/registro-completo', function () {
    return view('registro-completo');
});

Route::get('/tarjeta-presentacion', function () {
    return view('tarjeta-presentacion');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/listado-estudiantes', function () {
    return view('listado-estudiantes');
});

Route::get('/buscar-estudiantes', [EstudianteController::class, 'buscar'])
    ->name('estudiantes.buscar');
