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
        Schema::create('estudiantes_tutores', function (Blueprint $table) {
            $table->id();
            $table->integer('inscripcion_id');
            $table->integer('estudiante_id');
            $table->integer('tutor_id');
            $table->boolean('principal')->default(False)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes_tutores');
    }
};
