<?php

namespace App\Console\Commands;

use App\Models\AsignacionAula;
use App\Models\Estudiante;
use Illuminate\Console\Command;

class ImportarAsignaciones extends Command
{
    protected $signature = 'asignaciones:importar';

    protected $description = 'Importa las asignaciones de aula desde el segundo CSV';

    public function handle(): int
    {
        $ruta = base_path(
            'importaciones/LISTA DE POSTULANTES SEGUNDO CSVa.csv'
        );

        if (!file_exists($ruta)) {
            $this->error('No se encontró el archivo CSV.');

            return self::FAILURE;
        }

        $archivo = fopen($ruta, 'r');

        if ($archivo === false) {
            $this->error('No se pudo abrir el archivo CSV.');

            return self::FAILURE;
        }

        // Leer encabezado
        fgetcsv($archivo, 0, ';');

        $importados = 0;
        $omitidos = 0;
        $noEncontrados = 0;

        while (($fila = fgetcsv($archivo, 0, ';')) !== false) {

            if (empty($fila[0])) {
                $omitidos++;
                continue;
            }

            $nombre = trim(
                mb_convert_encoding($fila[0], 'UTF-8', 'Windows-1252')
            );

            $aula = trim($fila[1]);
            $piso = trim($fila[2]);
            $bloque = trim($fila[3]);

            // Buscar estudiante
            $estudiante = Estudiante::where('nombre', $nombre)->first();

            if (!$estudiante) {
                $noEncontrados++;
                $this->warn("Estudiante no encontrado: {$nombre}");
                continue;
            }

            // Evitar asignaciones duplicadas
            if (
                AsignacionAula::where(
                    'estudiante_id',
                    $estudiante->id
                )->exists()
            ) {
                $omitidos++;
                continue;
            }

            AsignacionAula::create([
                'estudiante_id' => $estudiante->id,
                'escuela' => '',
                'bloque' => $bloque,
                'piso' => $piso,
                'aula' => $aula,
                'croquis' => null,
            ]);

            $importados++;
        }

        fclose($archivo);

        $this->info("Asignaciones importadas: {$importados}");
        $this->info("Filas omitidas: {$omitidos}");
        $this->info("Estudiantes no encontrados: {$noEncontrados}");

        return self::SUCCESS;
    }
}
