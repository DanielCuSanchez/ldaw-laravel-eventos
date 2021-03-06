<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosEventosCreansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_eventos_creans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('usuarios')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('id_evento');
            $table->foreign('id_evento')->references('id')->on('eventos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('esta_activo');
            $table->date('fecha_creado');
            $table->date('fecha_actualizado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_eventos_creans');
    }
}
