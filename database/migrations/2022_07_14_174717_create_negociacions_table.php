<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegociacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negociacions', function (Blueprint $table) {
            $table->id();
            $table->string('fecha_de_facturacion')->nullable();
            $table->string('monto_en_soles')->nullable();
            $table->string('convocatoria')->nullable();
            $table->string('departamento_de_despacho')->nullable();
            $table->string('entidad_tecnica')->nullable();
            $table->string('estado_de_negociacion')->nullable();
            $table->string('etapa_de_contratacion')->nullable();
            $table->string('gano_entidad_tecnica')->nullable();
            $table->string('incluye_puerta_principal')->nullable();
            $table->string('perdio_entidad_tecnica')->nullable();
            $table->integer('porcentaje_de_cierre')->nullable();
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
        Schema::dropIfExists('negociacions');
    }
}
