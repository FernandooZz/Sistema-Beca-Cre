<?php

namespace Database\Seeders;

use App\Models\Administrador;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministradorSeeder extends Seeder
{
    public function run(): void
    {
        Administrador::create([
            'usuario' => 'admin',
            'contraseña' => Hash::make('Admin1234'),
        ]);
    }
}
