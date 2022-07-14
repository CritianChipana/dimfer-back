<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosTable extends Migration
{

    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->string('comentario');
            $table->string('convocatoria');
            $table->string('email_user');
            //entidad_tecnica_id
            $table->unsignedBigInteger('entidad_tecnica_id');
            $table->foreign('entidad_tecnica_id')->references('id')->on('entidad_tecnicas')->onDelete('cascade');
              //user_id
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
}
