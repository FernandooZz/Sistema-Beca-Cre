<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function buscar(Request $request)
{
    $busqueda = trim($request->input('nombre', ''));

    if ($busqueda === '') {
        return response()->json([]);
    }

    $estudiantes = Estudiante::where(function ($query) use ($busqueda) {
        $query->where('nombre', 'LIKE', "%{$busqueda}%")
                ->orWhere('ci', 'LIKE', "%{$busqueda}%");
    })
    ->orderBy('nombre')
    ->limit(10)
    ->get(['id', 'nombre', 'ci']);

    return response()->json($estudiantes);
}

    public function registrar(Request $request)
{

    $request->validate([
        'celular' => ['required', 'digits_between:1,8'],
        'colegio' => ['required', 'string', 'max:40'],
    ]);

    $estudiante = Estudiante::findOrFail(
        $request->input('estudiante_id')
    );

    // Si el estudiante ya registró una carrera,
    // no permitimos modificarla.
    if ($estudiante->carrera_id !== null) {
    return response()->json([
        'success' => false,
        'ya_registrado' => true,
        'message' => 'Este estudiante ya realizó su registro.',
        'estudiante_id' => $estudiante->id,
    ]);
}

    $carrera = Carrera::findOrFail(
        $request->input('carrera_id')
    );

    $estudiante->update([
    'celular' => $request->input('celular'),
    'colegio' => $request->input('colegio'),
    'carrera_id' => $carrera->id,
    'fecha_registro' => now(),
]);

    return response()->json([
        'success' => true,
        'message' => 'Registro completado correctamente.',
        'estudiante_id' => $estudiante->id,
    ]);
}
}
