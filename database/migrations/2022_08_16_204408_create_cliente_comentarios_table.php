<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_comentarios', function (Blueprint $table) {
            $table->id();
            $table->string('comentario')->nullable();
            $table->string('email_user')->nullable();
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->foreign('cliente_id')
                ->references('id')->on('clientes')
                ->onDelete('set null');
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
        Schema::dropIfExists('cliente_comentarios');
    }
}
