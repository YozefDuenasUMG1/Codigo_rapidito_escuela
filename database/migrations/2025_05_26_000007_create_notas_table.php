<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasTable extends Migration
{
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id('id_nota');
            $table->foreignId('id_inscripcion')->constrained('inscripciones', 'id_inscripcion')->cascadeOnDelete();
            $table->integer('punteo');
            $table->text('observacion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notas');
    }
}
