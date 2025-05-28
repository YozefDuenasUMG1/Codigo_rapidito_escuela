<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNivelesTable extends Migration
{
    public function up()
    {
        Schema::create('niveles', function (Blueprint $table) {
            $table->id('id_nivel');
            $table->enum('nombre', ['Principiantes I', 'Principiantes II', 'Avanzados I', 'Avanzados II']);
            $table->foreignId('id_grado')->constrained('grados', 'id_grado')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('niveles');
    }
}
