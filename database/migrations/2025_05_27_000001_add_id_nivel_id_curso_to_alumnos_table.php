<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('alumnos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_nivel')->nullable()->after('id_sucursal');
            $table->unsignedBigInteger('id_curso')->nullable()->after('id_nivel');
            $table->foreign('id_nivel')->references('id_nivel')->on('niveles')->onDelete('set null');
            $table->foreign('id_curso')->references('id_curso')->on('cursos')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('alumnos', function (Blueprint $table) {
            $table->dropForeign(['id_nivel']);
            $table->dropForeign(['id_curso']);
            $table->dropColumn(['id_nivel', 'id_curso']);
        });
    }
};
