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
        Schema::create('clases_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->integer('clase_id');
            $table->integer('estudiante_id');
            $table->float('calificacion',8,2)->nullable();
            $table->integer('acreditada')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clases_estudiantes');
    }
};
