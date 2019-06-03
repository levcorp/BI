<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignacionRolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_modulo', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('usuario_id');
            $table->unsignedInteger('modulo_id');
            $table->enum('escritura',['si','no']);
            $table->enum('lectura',['si','no']);
            $table->enum('eliminacion',['si','no']);
            $table->enum('edicion',['si','no']);
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('modulo_id')->references('id')->on('modulos');
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
        Schema::dropIfExists('asignacion_rols');
    }
}
