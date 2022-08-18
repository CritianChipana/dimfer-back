<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_comercial')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('departamento')->nullable();
            $table->string('provincia')->nullable();
            $table->string('tipo_de_cliente')->nullable();
            $table->string('canales_de_venta')->nullable();
            // para el elemento 2
            $table->string('razon_social')->nullable();
            $table->string('email_user')->nullable();
            $table->string('ruc')->nullable();
            $table->string('tipo_de_tienda')->nullable();
            $table->string('perfil_de_cliente')->nullable();
            $table->integer('n_tienda')->nullable();
            $table->boolean('activo')->nullable();
            $table->boolean('logo')->nullable();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->string('productos')->nullable();
            $table->boolean('exhibidor')->nullable();
            $table->boolean('remoledar_exhibidor')->nullable();
            $table->boolean('foto_local')->nullable();
            $table->boolean('tiene_material')->nullable();
            $table->string('redes_sociales')->nullable();
            $table->string('web')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('direccion_cliente')->nullable();
            $table->string('ubicacion_de_maps')->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
