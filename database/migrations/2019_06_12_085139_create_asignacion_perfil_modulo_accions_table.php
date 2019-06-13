<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignacionPerfilModuloAccionsTable extends Migration
{
    public function up()
    {
        Schema::create('asignacion_perfil_modulo_accions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('accion_id')->unsigned()->nullable();
            $table->integer('perfil_modulo_id')->unsigned()->nullable();
            $table->foreign('accion_id')->references('id')->on('accions')->onDelete('cascade');
            $table->foreign('perfil_modulo_id')->references('id')->on('asignacion_perfil_modulos')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('asignacion_perfil_modulo_accions');
    }
}
