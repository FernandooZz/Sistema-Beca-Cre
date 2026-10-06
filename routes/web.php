<?php

use App\Http\Controllers\EstudianteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradorController;

Route::get('/', function () {
    $ordenCarreras = [
        'Administración General',
        'Administración de Turismo',
        'Ingeniería Comercial',
        'Comercio Internacional',
        'Ingeniería en Marketing y Publicidad',
        'Contaduría Pública',
        'Ingeniería Financiera',
        'Comunicación Estratégica y Digital',
        'Ingeniería Industrial y Comercial',
        'Ingeniería Electrónica y Sistemas',
        'Ingeniería Mecánica Automotriz y Agroindustrial',
        'Ingeniería de Sistemas',
        'Ingeniería Eléctrica',
        'Ingeniería de Alimentos y Negocios',
        'Derecho',
        'Relaciones Internacionales',
        'Psicología',
        'Otros',
    ];

    $carreras = \App\Models\Carrera::whereIn(
        'nombre_carrera',
        $ordenCarreras
    )
    ->get()
    ->sortBy(function ($carrera) use ($ordenCarreras) {
        return array_search(
            $carrera->nombre_carrera,
            $ordenCarreras
        );
    });

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

    $cantidadRegistrados = $estudiantes->count();

    return view('listado-estudiantes', compact(
        'estudiantes',
        'cantidadRegistrados'
    ));
})->middleware('admin');


// AGREGAR OPCION DE DESCARGAR ARCHIVO CSV
Route::get('/descargar-estudiantes-csv', function () {
    $estudiantes = \App\Models\Estudiante::with('carrera')
        ->whereNotNull('carrera_id')
        ->orderBy('nombre')
        ->get();

    $nombreArchivo = 'estudiantes_registrados.csv';

    $headers = [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename="' . $nombreArchivo . '"',
    ];

    $callback = function () use ($estudiantes) {
        $archivo = fopen('php://output', 'w');

        // BOM para que Excel reconozca correctamente los caracteres
        fprintf($archivo, chr(0xEF) . chr(0xBB) . chr(0xBF));

        fputcsv($archivo, [
            'Nombre',
            'Carrera',
            'Fecha de registro'
        ], ';');

        foreach ($estudiantes as $estudiante) {
            fputcsv($archivo, [
                $estudiante->nombre,
                $estudiante->carrera->nombre_carrera,
                $estudiante->fecha_registro->format('d/m/Y H:i'),
            ], ';');
        }

        fclose($archivo);
    };

    return response()->stream($callback, 200, $headers);
})->middleware('admin');

Route::get('/buscar-estudiantes', [EstudianteController::class, 'buscar'])
    ->name('estudiantes.buscar');

Route::post('/registrar-estudiante', [EstudianteController::class, 'registrar'])
->name('estudiantes.registrar');
