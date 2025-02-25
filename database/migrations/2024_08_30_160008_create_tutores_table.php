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
        Schema::create('tutores', function (Blueprint $table) {
            $table->id();
            $table->string('clave', 30)->nullable();
            $table->string('nombre');
            $table->string('apellidop');
            $table->string('apellidom')->nullable();
            $table->string('rfc')->nullable();
            $table->string('curp')->nullable();
            $table->string('orcid')->nullable();
            $table->integer('sexo_id')->nullable();
            $table->integer('adscripcion_id')->nullable();
            $table->integer('grado_id')->nullable();
            $table->string('area')->nullable();
            $table->integer('sni_id')->nullable();
            $table->integer('pride_id')->nullable();
            $table->integer('contrato_id')->nullable();
            $table->string('email')->nullable();
            $table->boolean('activo')->default(True);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutores');
    }
};
