<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUsersTable extends Migration{
    public function up(){
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('cargo')->nullable();
            $table->enum('estado',['activo','no activo'])->nullable();
            $table->enum('global',['si','no'])->nullable();
            $table->string('ciudad')->nullable();
            $table->string('departamento')->nullable();
            $table->string('objectguid')->nullable();            
            $table->string('celular')->nullable();
            $table->string('codigo')->nullable();
            $table->string('interno')->nullable();
            $table->boolean('cambiar')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('perfil_id')->unsigned()->nullable();
            $table->integer('sucursal_id')->unsigned()->nullable();
            $table->dateTime('update')->nullable();
            $table->foreign('sucursal_id')->references('id')->on('sucursals')->onDelete('cascade');
            $table->foreign('perfil_id')->references('id')->on('perfils')->onDelete('cascade');
            $table->rememberToken();
        });
    }
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
