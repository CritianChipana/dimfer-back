<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactoDistribuidorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto_distribuidors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('telefono')->nullable();
            $table->string('telefono2')->nullable();
            $table->string('direccion')->nullable();
            $table->string('email')->nullable();
            $table->string('email2')->nullable();
            $table->string('cargo')->nullable();
            //cliente_id
            $table->foreign('cliente_id')
                ->references('id')->on('clientes')
                ->onDelete('set null');
            $table->unsignedBigInteger('cliente_id')->nullable();
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
        Schema::dropIfExists('contacto_distribuidors');
    }
}
