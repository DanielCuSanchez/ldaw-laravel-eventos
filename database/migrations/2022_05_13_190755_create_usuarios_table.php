<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rol');
            $table->foreign('id_rol')->references('id')->on('roles')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nombre');
            $table->string('correo_electronico');
            $table->string('password');
            $table->string('celular');
            $table->string('estado');
            $table->string('edad');
            $table->string('empresa');
            $table->date('fecha_creado');
            $table->date('fecha_actualizado');
        });

        Schema::table('usuarios', function ($table) {
            $table->dropColumn('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
