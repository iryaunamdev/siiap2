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
        Schema::create('estudiantes_seguimientos', function (Blueprint $table) {
            $table->id();
            $table->integer('estudiante_id');
            $table->integer('tipo_id')->nullable();
            $table->date('fecha')->nullable();
            $table->string('titulo')->nullable();
            $table->integer('estatus_id')->nullable();
            $table->text('comentarios')->nullable();
            $table->string('bibcode')->nullable();
            $table->string('doi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes_seguimientos');
    }
};
