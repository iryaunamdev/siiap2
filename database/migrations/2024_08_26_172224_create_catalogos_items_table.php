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
        Schema::create('catalogos_items', function (Blueprint $table) {
            $table->id();
            $table->integer('catalogo_id');
            $table->string('clave', 30);
            $table->string('nombre');
            $table->boolean('activo')->default(True);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogos_items');
    }
};
