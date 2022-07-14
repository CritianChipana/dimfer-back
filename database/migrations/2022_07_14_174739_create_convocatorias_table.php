<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvocatoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convocatorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('cantidad_de_entidades_tecnicas');
            $table->string('cantidad_de_modulos_registrados');
            $table->string('cantidad_de_modulos_licitados');
            $table->string('cantidad_de_modulos_ganados');
            $table->string('porcentaje_cantidad_de_modulos_participados');
            $table->string('porcentaje_cantidad_de_modulos_eficacia');
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('convocatorias');
    }
}
