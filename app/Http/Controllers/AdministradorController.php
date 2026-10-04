<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    public function login(Request $request)
    {
        $administrador = Administrador::where(
            'usuario',
            $request->input('usuario')
        )->first();

        if (
            !$administrador ||
            !Hash::check(
                $request->input('contraseña'),
                $administrador->contraseña
            )
        ) {
            return back()->with('error', 'Usuario o contraseña incorrectos.');
        }

        session([
            'administrador_id' => $administrador->id,
            'administrador_usuario' => $administrador->usuario,
        ]);

        return redirect('/listado-estudiantes');
    }

    public function logout(Request $request)
{
    $request->session()->forget([
        'administrador_id',
        'administrador_usuario',
    ]);

    $request->session()->regenerateToken();

    return redirect('/login');
}
}
