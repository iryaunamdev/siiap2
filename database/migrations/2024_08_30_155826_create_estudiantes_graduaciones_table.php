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
        Schema::create('estudiantes_graduaciones', function (Blueprint $table) {
            $table->id();
            $table->integer('estudiante_id');
            $table->integer('ingreso_id');
            $table->integer('semestre_id');
            $table->integer('grado_id');
            $table->integer('modalidad_id')->nullable();
            $table->integer('adscripcion_id');
            $table->date('fecha')->nullable();
            $table->string('titulo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes_graduaciones');
    }
};
