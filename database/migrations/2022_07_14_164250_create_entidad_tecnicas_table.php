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
            $table->string('departamento_fiscal')->nullable();
            $table->string('departamento_real')->nullable();
            $table->string('direccion_fiscal')->nullable();
            $table->float('latitud_fiscal_gps',4 , 15)->nullable();
            $table->float('longitud_fiscal_gps',4 , 15)->nullable();
            $table->string('direccion_real')->nullable();
            $table->float('latitud_real_gps',4 , 16)->nullable();
            $table->float('longitud_real_gps',4 , 16)->nullable();
            $table->string('email_user')->nullable();
            $table->string('estado')->nullable();
            $table->text('foto_direccion_fiscal')->nullable();
            $table->text('foto_direccion_real')->nullable();
            $table->string('medio_de_contacto')->nullable();
            $table->string('proveedor_actual')->nullable();
            $table->string('provincia_fiscal')->nullable();
            $table->string('provincia_real')->nullable();
            $table->string('razon_social')->nullable();
            $table->string('representante_legal')->nullable();
            $table->string('ruc')->nullable();
            $table->string('tiene_grupo')->nullable();
            $table->string('tipo_de_cliente')->nullable();
            $table->string('tipo_de_construccion')->nullable();
            $table->boolean('verificado_direccion_fiscal_gps')->nullable();
            $table->boolean('verificado_direccion_real_gps')->nullable();
            $table->string('vigencia')->nullable();
            $table->string('zona')->nullable();

            //user_id
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('entidad_tecnicas');
    }
}
