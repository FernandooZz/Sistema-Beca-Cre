<?php

namespace App\Http\Controllers;

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
}