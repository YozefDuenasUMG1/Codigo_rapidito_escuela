<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesoresTable extends Migration
{
    public function up()
    {
        Schema::create('profesores', function (Blueprint $table) {
            $table->id('id_profesor');
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('telefono');
            $table->string('especialidad');
            $table->unsignedBigInteger('id_sucursal')->nullable();
            $table->foreign('id_sucursal')->references('id_sucursal')->on('sucursales')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profesores');
    }
}
