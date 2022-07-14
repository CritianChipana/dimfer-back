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
            $table->string('nombre')->nullable();
            $table->string('cantidad_de_entidades_tecnicas')->nullable();
            $table->string('cantidad_de_modulos_registrados')->nullable();
            $table->string('cantidad_de_modulos_licitados')->nullable();
            $table->string('cantidad_de_modulos_ganados')->nullable();
            $table->string('porcentaje_cantidad_de_modulos_participados')->nullable();
            $table->string('porcentaje_cantidad_de_modulos_eficacia')->nullable();
            $table->string('estado')->nullable();
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
