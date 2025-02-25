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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('cuenta', 30)->nullable();
            $table->string('orcid', 30)->nullable();
            $table->string('nombre');
            $table->string('apellidop');
            $table->string('apellidom')->nullable();
            $table->string('rfc', 50)->nullable();
            $table->string('curp', 50)->nullable();
            $table->integer('sexo_id')->nullable();
            $table->integer('nacionalidad_id')->nullable();
            $table->string('lugar_nacimiento', 100)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('email')->nullable();
            $table->string('email_alt')->nullable();
            $table->string('photo_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
