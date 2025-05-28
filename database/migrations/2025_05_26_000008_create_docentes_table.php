<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->id('id_docente');
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('telefono', 15);
            $table->string('especialidad');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('docentes');
    }
};
