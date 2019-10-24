@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app">
  <div class="col-xs-12 col-sm-12 col-md-6 col-md-6">
    <div class="box box-info">
        <div class="box-header">
          <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <h3 class="box-title">Grupos Registrados</h3>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <div class="pull-right" style="margin-right: 10px">
                    <el-button
                    size="mini"
                    type="primary"
                    icon="el-icon-plus"
                    @click="handleCreate()"
                    >Crear Grupo
                    </el-button>
                  </div>
              </div>
          </div>
        </div>
        <div class="box-body">
          <el-table :data="grupos.filter(data => !searchGrupos || data.NOMBRE.toLowerCase().includes(searchGrupos.toLowerCase()) || data.DESCRIPCION.toLowerCase().includes(searchGrupos.toLowerCase()))" style="width: 100%" height="450" highlight-current-row @current-change="handleCurrentChange">
              <el-table-column width="70" align="center" label="#">
                <template slot-scope="scope">
                  <span style="margin-left: 10px">@{{ scope.$index+1 }}</span>
                </template>
              </el-table-column>
              <el-table-column align="center" prop="NOMBRE" label="Nombre"></el-table-column>
              <el-table-column align="center" prop="DESCRIPCION" label="Descripcion"></el-table-column>
              <el-table-column align="center" label="Operaciones">
                  <template slot="header" slot-scope="scope">
                    <el-input
                      v-model="searchGrupos"
                      size="mini"
                      placeholder="Buscar Grupo"/>
                  </template>
                  <template slot-scope="scope">
                          <el-button plain circle icon="el-icon-plus" size="mini" type="warning" @click="handleAssignment(scope.$index, scope.row)"></el-button>
                          <el-button plain circle icon="el-icon-edit" size="mini" type="primary" @click="handleEdit(scope.$index, scope.row)"></el-button>
                          <el-button plain circle size="mini" type="danger" icon="el-icon-delete" @click="handleDelete(scope.$index, scope.row)"></el-button>
                  </template>
              </el-table-column>
            </el-table>
        </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-6 col-md-6">
        <div class="box box-info">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                        <h3 class="box-title">Usuarios Asignados</h3>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <el-table :data="asignaciones.filter(data => !searchAsignaciones || data.usuario.nombre.toLowerCase().includes(searchAsignaciones.toLowerCase()) || data.usuario.apellido.toLowerCase().includes(searchAsignaciones.toLowerCase()))" style="width: 100%" height="450">
                    <el-table-column width="70" align="center" label="#">
                    <template slot-scope="scope">
                        <span style="margin-left: 10px">@{{ scope.$index + 1}}</span>
                    </template>
                    </el-table-column>
                    <el-table-column align="center" prop="usuario.nombre" label="Nombre"></el-table-column>
                    <el-table-column align="center" prop="usuario.apellido" label="Apellido"></el-table-column>
                    <el-table-column align="center" label="Operaciones">
                        <template slot="header" slot-scope="scope">
                        <el-input
                            v-model="searchAsignaciones"
                            size="mini"
                            placeholder="Buscar Grupo"/>
                        </template>
                        <template slot-scope="scope">
                            <el-button plain circle size="mini" type="danger" icon="el-icon-delete" @click="handleAssignmentDelete(scope.$index, scope.row)"></el-button>
                        </template>
                    </el-table-column>
            </template>
            </div>
        </div>
  </div>
  @include('panel.registros.grupo.create')
  @include('panel.registros.grupo.edit')
  @include('panel.registros.grupo.add')
</div>
@section('script')
{!!Html::script('js/grupo.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop
