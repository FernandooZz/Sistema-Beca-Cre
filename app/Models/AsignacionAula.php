<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AsignacionAula extends Model
{
    protected $fillable = [
        'estudiante_id',
        'escuela',
        'bloque',
        'piso',
        'aula',
        'croquis',
    ];

    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(Estudiante::class);
    }
}
