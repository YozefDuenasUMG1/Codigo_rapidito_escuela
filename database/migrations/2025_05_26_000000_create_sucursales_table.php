<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalesTable extends Migration
{
    public function up()
    {
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id('id_sucursal');
            $table->string('nombre');
            $table->string('ubicacion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sucursales');
    }
}
