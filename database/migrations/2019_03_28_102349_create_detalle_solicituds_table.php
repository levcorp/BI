<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleSolicitudsTable extends Migration
{
    public function up()
    {
        Schema::create('detalle_solicituds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serie');
            $table->string('fabricante');
            $table->string('cod_fabricante');
            $table->string('proveedor');
            $table->string('cod_proveedor');
            $table->string('especialidad');
            $table->string('cod_especialidad');
            $table->string('familia')->nullable();
            $table->string('subfamilia')->nullable();
            $table->string('medida');
            $table->string('cod_venta');
            $table->string('cod_compra');
            $table->text('descripcion');
            $table->text('comentarios');
            $table->integer('solicitud_id')->unsigned();
            $table->foreign('solicitud_id')->on('solicituds')->references('id');
        });
    }
    public function down()
    {
        Schema::dropIfExists('detalle_solicituds');
    }
}
