<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignacionDashboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * BIBIBIBIBIBIBI
     */
    public function up()
    {
        Schema::create('asignacion_dashboards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->integer('dashboard_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('dashboard_id')->references('id')->on('dashboards');
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
        Schema::dropIfExists('asignacion_dashboards');
    }
}
