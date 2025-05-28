<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionesTable extends Migration
{
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id('id_inscripcion');
            $table->foreignId('id_alumno')->constrained('alumnos', 'id_alumno')->cascadeOnDelete();
            $table->foreignId('id_nivel')->constrained('niveles', 'id_nivel')->cascadeOnDelete();
            $table->foreignId('id_curso')->constrained('cursos', 'id_curso')->cascadeOnDelete();
            $table->foreignId('id_profesor')->constrained('profesores', 'id_profesor')->cascadeOnDelete();
            $table->dateTime('fecha_inscripcion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inscripciones');
    }
}
