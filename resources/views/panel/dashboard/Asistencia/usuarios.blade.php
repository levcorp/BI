@extends('layouts.table')
@section('contenido')
<div class="row" id="app">
  <div class="col-xs-12">
    <div class="box box-info">
      <div class="box-header">
        <div class="box-header">
          <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                <p style="font-size: 15px">
                    <strong>&nbsp;&nbsp;Registros</strong>
                </p>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <div class="pull-right" style="margin-right: 10px">
                    <el-button size="mini" @click="handleShowCreateTolerancia()" type="primary" icon="el-icon-notebook-2" round>Crear Tolerancia</el-button>
                  </div>
                  <div class="pull-left" style="margin-right: 10px">
                    <el-button size="mini" @click="handleShowTolerancias()" type="primary" icon="el-icon-notebook-2" round>Lista de Tolerancia</el-button>
                  </div>
              </div>
          </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <el-table :data="usuarios.filter(data => !search || data.nombre.toLowerCase().includes(search.toLowerCase())|| data.apellido.toLowerCase().includes(search.toLowerCase()))" style="width: 100%" height="450" >
            <el-table-column align="center" prop="nombre" label="Nombre" ></el-table-column>
            <el-table-column align="center" prop="apellido" label="Apellido" ></el-table-column>
            <el-table-column align="center" prop="email" label="Correo Electronico"></el-table-column>
            <el-table-column align="center" label="Tipo Tolerancia">
              <template slot-scope="scope">
                <div v-if="scope.row.tipo_registros_id">
                    <el-tag type="success">@{{scope.row.tipo_registro.titulo}}</el-tag>
                </div>
                <div v-else>
                    <el-tag type="danger">Sin Asignar</el-tag>
                </div>
              </template>
            </el-table-column>
            <el-table-column align="center" label="Hora Max.">
              <template slot-scope="scope">
                <div v-if="scope.row.tipo_registros_id">
                    <el-tag type="success">@{{scope.row.tipo_registro.hora}}</el-tag>
                </div>
                <div v-else>
                    <el-tag type="danger">Sin Asignar</el-tag>
                </div>
              </template>
            </el-table-column>
            <!---<el-table-column align="center" prop="memberof[0]" label="Miembro" width="180"></el-table-column>-->
            <el-table-column align="center" label="Operaciones" width="150">
              <template slot="header" slot-scope="scope">
                <el-input
                  v-model="search"
                  size="mini"
                  placeholder="Buscar Usuario"/>
              </template>
              <template slot-scope="scope">
                <el-button
                  size="mini"
                  type="success"
                  circle
                  icon="el-icon-plus"
                  @click="handleShowAsignarTolerancia(scope.$index, scope.row)">
                </el-button>
              </template>
            </el-table-column>
        </el-table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  @include('panel.dashboard.Asistencia.listaTolerancia')
  @include('panel.dashboard.Asistencia.crearTolerancia')
  @include('panel.dashboard.Asistencia.asignarTolerancia')

  <!-- /.col -->
</div>
@section('script')
{!!Html::script('js/usuariosRegistros.js')!!}
@endsection
@stop
