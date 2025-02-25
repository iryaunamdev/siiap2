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
        Schema::create('estudiantes_bajas', function (Blueprint $table) {
            $table->id();
            $table->integer('estudiante_id');
            $table->integer('ingreso_id');
            $table->integer('grado_id');
            $table->integer('semestre_id');
            $table->integer('tipo_id');
            $table->date('fecha')->nullable();
            $table->integer('motivo_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes_bajas');
    }
};
