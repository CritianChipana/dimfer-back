<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntidadTecnicasTable extends Migration
{

    public function up()
    {
        Schema::create('entidad_tecnicas', function (Blueprint $table) {
            $table->id();
            $table->string('departamentoFiscal');
            $table->string('departamentoReal');
            $table->string('direccionFiscal');
            $table->json('direccionFiscalGPS');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('entidad_tecnicas');
    }
}
