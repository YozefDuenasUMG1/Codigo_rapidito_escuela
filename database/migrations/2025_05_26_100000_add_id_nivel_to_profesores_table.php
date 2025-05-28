<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('profesores', function (Blueprint $table) {
            $table->unsignedBigInteger('id_nivel')->nullable()->after('id_sucursal');
            $table->foreign('id_nivel')->references('id_nivel')->on('niveles')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('profesores', function (Blueprint $table) {
            $table->dropForeign(['id_nivel']);
            $table->dropColumn('id_nivel');
        });
    }
};
