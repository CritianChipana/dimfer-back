<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('telefono')->nullable();
            $table->string('telefono2')->nullable();
            $table->string('direccion')->nullable();
            $table->string('email')->nullable();
            $table->string('email2')->nullable();
            $table->string('cargo')->nullable();
            //entidad_tecnica_id
            $table->unsignedBigInteger('entidad_tecnica_id')->nullable();
            $table->foreign('entidad_tecnica_id')->references('id')->on('entidad_tecnicas')->onDelete('cascade');
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
        Schema::dropIfExists('contactos');
    }
}
