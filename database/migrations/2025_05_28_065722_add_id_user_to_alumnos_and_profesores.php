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
        Schema::table('alumnos', function ($table) {
            $table->foreignId('id_user')->nullable()->after('id_alumno')->constrained('users')->cascadeOnDelete();
        });
        Schema::table('profesores', function ($table) {
            $table->foreignId('id_user')->nullable()->after('id_profesor')->constrained('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumnos', function ($table) {
            $table->dropForeign(['id_user']);
            $table->dropColumn('id_user');
        });
        Schema::table('profesores', function ($table) {
            $table->dropForeign(['id_user']);
            $table->dropColumn('id_user');
        });
    }
};
