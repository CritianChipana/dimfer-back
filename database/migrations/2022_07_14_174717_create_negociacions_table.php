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
            $table->string('fecha_de_facturacion');
            $table->string('monto_en_soles');
            $table->string('convocatoria');
            $table->string('departamento_de_despacho');
            $table->string('entidad_tecnica');
            $table->string('estado_de_negociacion');
            $table->string('etapa_de_contratacion');
            $table->string('gano_entidad_tecnica');
            $table->string('incluye_puerta_principal');
            $table->string('perdio_entidad_tecnica');
            $table->integer('porcentaje_de_cierre');
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
