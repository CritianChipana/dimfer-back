<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locals', function (Blueprint $table) {
            $table->id();
            $table->float('latitud')->nullable();
            $table->float('longitud')->nullable();
            $table->string('direccion')->nullable();

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
        Schema::dropIfExists('locals');
    }
}
