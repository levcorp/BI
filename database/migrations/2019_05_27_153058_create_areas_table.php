<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    public function up(){
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->text('descripcion');
            $table->boolean('estado');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
