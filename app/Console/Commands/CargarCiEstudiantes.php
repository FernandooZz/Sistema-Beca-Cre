<?php

namespace App\Console\Commands;

use App\Models\Estudiante;
use Illuminate\Console\Command;

class CargarCiEstudiantes extends Command
{
    protected $signature = 'estudiantes:cargar-ci';

    protected $description = 'Carga los CI de los estudiantes desde el CSV';

    public function handle()
    {
        $ruta = base_path(
            'importaciones/LISTA DE POSTULANTES EXAMEN CRE 2026.csv'
        );

        if (!file_exists($ruta)) {
            $this->error('No se encontró el archivo CSV.');
            return Command::FAILURE;
        }

        $archivo = fopen($ruta, 'r');

        // Saltar encabezado
        fgetcsv($archivo, 0, ';');

        $estudiantes = Estudiante::orderBy('id')->get();

        $indice = 0;
        $actualizados = 0;

        while (($fila = fgetcsv($archivo, 0, ';')) !== false) {

            if (count($fila) < 2) {
                continue;
            }

            $ci = trim($fila[1]);

            if ($ci === '') {
                continue;
            }

            if (!isset($estudiantes[$indice])) {
                $this->error('El CSV tiene más registros que la base de datos.');
                fclose($archivo);
                return Command::FAILURE;
            }

            $estudiante = $estudiantes[$indice];

            $estudiante->update([
                'ci' => $ci,
            ]);

            $actualizados++;
            $indice++;
        }

        fclose($archivo);

        $this->info("CI actualizados: {$actualizados}");

        return Command::SUCCESS;
    }
}
