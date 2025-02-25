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
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->integer('materia_id');
            $table->integer('tipo_id')->nullable();
            $table->integer('grado_id')->nullable();
            $table->integer('semestre_id')->nullable();
            $table->integer('programa_id')->nullable();
            $table->integer('adscripcion_id')->nullable();
            $table->integer('grupo')->nullable();
            $table->integer('horas')->nullable();
            $table->integer('creditos')->nullable();
            $table->string('titulo_alt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clases');
    }
};
