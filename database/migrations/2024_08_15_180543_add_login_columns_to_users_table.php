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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('activo')->after('password')->nullable();
            $table->timestamp('last_login_at')->after('activo')->nullable();
            $table->string('last_login_ip')->after('last_login_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('activo');
            $table->dropColumn('last_login_at');
            $table->dropColumn('last_login_ip');
        });
    }
};
