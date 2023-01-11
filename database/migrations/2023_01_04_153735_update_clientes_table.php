<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('logo')->change();
            $table->text('redes_sociales')->change();
            $table->text('web')->change();
            $table->text('link_facebook')->change();
        });
    }

    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            //
        });
    }
}
