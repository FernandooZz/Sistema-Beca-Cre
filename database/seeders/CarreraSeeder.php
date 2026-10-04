<?php

namespace Database\Seeders;

use App\Models\Carrera;
use Illuminate\Database\Seeder;

class CarreraSeeder extends Seeder
{
    public function run(): void
    {
        $carreras = [
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

        foreach ($carreras as $carrera) {
            Carrera::create([
                'nombre_carrera' => $carrera,
            ]);
        }
    }
}
