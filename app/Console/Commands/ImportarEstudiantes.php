<?php

namespace App\Console\Commands;

use App\Models\Estudiante;
use Illuminate\Console\Command;

class ImportarEstudiantes extends Command
{
    protected $signature = 'estudiantes:importar';

    protected $description = 'Importa estudiantes desde el CSV inicial';

    public function handle(): int
    {
        $ruta = base_path('importaciones/LISTA DE POSTULANTES EXAMEN CRE 2026.csv');

        if (!file_exists($ruta)) {
            $this->error('No se encontró el archivo CSV.');
            return self::FAILURE;
        }

        $archivo = fopen($ruta, 'r');

        if ($archivo === false) {
            $this->error('No se pudo abrir el archivo CSV.');
            return self::FAILURE;
        }

        $encabezado = fgetcsv($archivo, 0, ';');

        $importados = 0;
        $omitidos = 0;

        while (($fila = fgetcsv($archivo, 0, ';')) !== false) {
            if (empty($fila[0])) {
                $omitidos++;
                continue;
            }

            $nombre = trim(mb_convert_encoding($fila[0], 'UTF-8', 'Windows-1252'));

            Estudiante::create([
                'nombre' => $nombre,
            ]);

            $importados++;
        }

        fclose($archivo);

        $this->info("Estudiantes importados: {$importados}");
        $this->info("Filas omitidas: {$omitidos}");

        return self::SUCCESS;
    }
}
