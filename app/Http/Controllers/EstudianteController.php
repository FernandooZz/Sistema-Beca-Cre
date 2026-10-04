<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function buscar(Request $request)
    {
        $nombre = trim($request->input('nombre', ''));

        if ($nombre === '') {
            return response()->json([]);
        }

        $estudiantes = Estudiante::where('nombre', 'LIKE', "%{$nombre}%")
            ->orderBy('nombre')
            ->limit(10)
            ->get([
                'id',
                'nombre',
            ]);

        return response()->json($estudiantes);
    }

    public function registrar(Request $request)
{
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
