<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
        {
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->string('ci')->nullable()->after('nombre');
            $table->string('celular')->nullable()->after('ci');
            $table->string('colegio')->nullable()->after('celular');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->dropColumn([
                'ci',
                'celular',
                'colegio',
            ]);
        });
    }


};
