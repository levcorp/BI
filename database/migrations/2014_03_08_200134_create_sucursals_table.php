<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSucursalsTable extends Migration
{
    public function up()
    {
        Schema::create('sucursals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre'); 
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('telefono');
            $table->string('fax');
            $table->string('celular')->nullable();
            $table->string('correo');
            $table->dateTime('create');
            $table->dateTime('update');
        });
    }
    public function down()
    {
        Schema::dropIfExists('sucursals');
    }
}
