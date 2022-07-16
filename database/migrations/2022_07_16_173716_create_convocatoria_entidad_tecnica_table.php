<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvocatoriaEntidadTecnicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convocatoria_entidad_tecnica', function (Blueprint $table) {
            $table->id();
            //entidad_tecnica_id
            $table->unsignedBigInteger('entidad_tecnica_id');
            $table->foreign('entidad_tecnica_id')->references('id')->on('entidad_tecnicas')->onDelete('cascade');
            //convocatoria_id
            $table->unsignedBigInteger('convocatoria_id');
            $table->foreign('convocatoria_id')->references('id')->on('convocatorias')->onDelete('cascade');
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
        Schema::dropIfExists('convocatoria_entidad_tecnica');
    }
}
