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
        Schema::create('estudiantes_ingresos', function (Blueprint $table) {
            $table->id();
            $table->integer('estudiante_id');
            $table->integer('semestre_id');
            $table->integer('grado_id');
            $table->integer('universidad_id')->nullable();
            $table->integer('programa_id')->nullable();
            $table->integer('procedencia_id')->nullable();
            $table->float('promedio',8,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes_ingresos');
    }
};
