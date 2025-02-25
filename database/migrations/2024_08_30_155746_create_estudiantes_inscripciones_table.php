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
        Schema::create('estudiantes_inscripciones', function (Blueprint $table) {
            $table->id();
            $table->integer('estudiante_id');
            $table->integer('ingreso_id')->nullable();
            $table->integer('semestre_id');
            $table->integer('grado_id');
            $table->integer('programa_id')->nullable();
            $table->integer('adscripcion_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes_inscripciones');
    }
};
