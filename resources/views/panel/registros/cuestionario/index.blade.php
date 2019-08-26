@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app">
  <div class="col-xs-12" v-cloak>
      <input type="text" :value="usuario_id='{{Auth::user()->id}}'" hidden>
    <div class="box box-info">
        <div class="box-header">
          <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <h3 class="box-title">Cuestionarios Registrados</h3>  
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <div class="pull-right" style="margin-right: 10px">
                    <el-button
                    size="mini"
                    type="primary"
                    icon="el-icon-plus"
                    @click="handleCreate()"
                    >Crear Cuestionario
                    </el-button>
                  </div>
              </div>
          </div>
        </div>
        <div class="box-body" style="margin:15px">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6" v-for="cuestionario in cuestionarios" >
                <el-card shadow="always" :body-style="{ padding: '0px' }">
                  <div style="padding: 15px;background-image:url({{asset('../images/cuestionario.jpg')}});">
                    <div class="text-center" style="color: white">
                      <p><strong>@{{cuestionario.TITULO | uppercase }}</strong></p>
                      <p>
                        <strong>
                            @{{cuestionario.FECHA_REGISTRO | moment('calendar',null,{sameElse : 'YYYY-MM-DD HH:mm'}) | capitalize({ onlyFirstLetter: true })}}
                        </strong>
                      </p>
                    </div>
                  </div>
                  <div>
                    <div class="row"  style="padding: 5px">
                      <div class="col-xs-12 col-md-7" >
                        <div class="text-center">
                          <el-dropdown trigger="click" @command="handleCommand">
                              <el-button type="primary" size="mini" style="padding: 4px;">
                                Acciones
                              </el-button>
                              <el-dropdown-menu slot="dropdown">
                                <el-dropdown-item v-if="cuestionario.resp==0" :command="{type:'edit',cuestionario:cuestionario}" icon="el-icon-edit">Editar</el-dropdown-item>
                                <el-dropdown-item :command="{type:'show',cuestionario:cuestionario}" icon="el-icon-plus">Ver</el-dropdown-item>
                                <el-dropdown-item :command="{type:'more',cuestionario:cuestionario}" icon="el-icon-more">Datos</el-dropdown-item>
                                <el-dropdown-item v-if="cuestionario.resp==0" :command="{type:'grupo',cuestionario:cuestionario}" icon="el-icon-user">Grupo</el-dropdown-item>
                                <el-dropdown-item v-if="cuestionario.resp==0" :command="{type:'delete',cuestionario:cuestionario}" icon="el-icon-close">Eliminar</el-dropdown-item>
                              </el-dropdown-menu>
                            </el-dropdown>
                        </div>
                      </div>
                      <div class="col-xs-12 col-md-4" >
                        <div class="text-center">
                          <el-button style="padding: 4px;" @click="handleEstadoChange(cuestionario)" v-if="cuestionario.ESTADO == 1" size="mini" plain type="primary">Activo</el-button>
                          <el-button style="padding: 4px;" @click="handleEstadoChange(cuestionario)" v-else size="mini" type="danger" plain>No activo</el-button>
                        </div>
                      </div>
                    </div>
                  </div>
                </el-card>
                <br>
              </div>
            </div>
        </div>
       @include('panel.registros.cuestionario.drawer')
    </div>
    @include('panel.registros.cuestionario.show')
    @include('panel.registros.cuestionario.create')
    @include('panel.registros.cuestionario.edit')
    @include('panel.registros.cuestionario.grupo')
  </div>
</div>
@section('script')
{!!Html::script('js/cuestionario.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop