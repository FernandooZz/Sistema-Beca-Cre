<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('asignacion_aulas', function (Blueprint $table) {
            $table->unique('estudiante_id');
        });
    }

    public function down(): void
    {
        Schema::table('asignacion_aulas', function (Blueprint $table) {
            $table->dropUnique(['estudiante_id']);
        });
    }
};
