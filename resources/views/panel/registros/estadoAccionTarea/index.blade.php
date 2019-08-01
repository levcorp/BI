@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app">
  <div class="col-md-6">
    <div class="box box-info">
        <div class="box-header">
          <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <h3 class="box-title">Estados Tarea Registrados</h3>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <div class="pull-right" style="margin-right: 10px">
                    <el-button
                    size="mini"
                    type="primary"
                    icon="el-icon-plus"
                    @click="handleCreateEstadoTarea()"
                    >Crear Estado Tarea
                    </el-button>
                  </div>
              </div>
          </div>
        </div>
        <div class="box-body">
          <el-table :data="estadosTarea.filter(data => !searchEstadoTarea || data.ESTADO_TAREA.toLowerCase().includes(searchEstadoTarea.toLowerCase()))" style="width: 100%" height="450" highlight-current-row>
              <el-table-column align="center" prop="ESTADO_TAREA" label="Titulo"></el-table-column>
              <el-table-column align="center" prop="ICON" label="Icono">
                  <template slot-scope="scope">
                    <div slot="reference">
                        <i :class="scope.row.ICON"></i>
                    </div>
                  </template>
              </el-table-column>
              <el-table-column align="center" prop="COLOR" label="Tipo" sortable>
                <template slot-scope="scope">
                  <div slot="reference">
                      <el-tag
                      size="mini"
                      :type="scope.row.COLOR"
                      effect="dark">
                      @{{ scope.row.COLOR }}
                    </el-tag>
                  </div>
                </template>
              </el-table-column>
              </el-table-column>
              <el-table-column align="center" prop="TAG" label="Proceso" width="100" sortable></el-table-column>
              <el-table-column align="center" label="Operaciones" width="150">
                  <template slot="header" slot-scope="scope">
                    <el-input
                      v-model="searchEstadoTarea"
                      size="mini"
                      placeholder="Buscar Estado"/>
                  </template>
                  <template slot-scope="scope">
                      <el-button  v-if="scope.row.id!=1" circle icon="el-icon-edit" size="mini" type="primary" @click="handleEditEstadoTarea(scope.$index, scope.row)"></el-button>
                      <span v-else>Sin acciones</span>
                      <el-button v-if="(scope.row.tareas).length ==0 && scope.row.id!=1 &&  scope.row.id!=2" circle size="mini" type="danger" icon="el-icon-delete" @click="handleDeleteEstadoTarea(scope.$index, scope.row)"></el-button>
                  </template>
              </el-table-column>
          </el-table>
        </div>
    </div>
  </div>
  <div class="col-md-6">
      <div class="box box-info">
          <div class="box-header">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                    <h3 class="box-title">Estados Accion Registrados</h3>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                    <div class="pull-right" style="margin-right: 10px">
                      <el-button
                      size="mini"
                      type="primary"
                      icon="el-icon-plus"
                      @click="handleCreateEstadoAccion()"
                      >Crear Estado Accion
                      </el-button>
                    </div>
                </div>
            </div>
          </div>
          <div class="box-body">
            <el-table :data="estadosAccion.filter(data => !searchEstadoAccion || data.ACCION.toLowerCase().includes(searchEstadoAccion.toLowerCase()))" style="width: 100%" height="450" highlight-current-row>
                <el-table-column align="center" prop="ACCION" label="Titulo"></el-table-column>
                <el-table-column align="center" prop="ICON" label="Icono">
                    <template slot-scope="scope">
                      <div slot="reference">
                          <i :class="scope.row.ICON"></i>
                      </div>
                    </template>
                </el-table-column>
                <el-table-column align="center" prop="COLOR" label="Tipo" sortable>
                  <template slot-scope="scope">
                    <div slot="reference">
                        <el-tag
                        size="mini"
                        :type="scope.row.COLOR"
                        effect="dark">
                        @{{ scope.row.COLOR }}
                      </el-tag>
                    </div>
                  </template>
                </el-table-column>
                <el-table-column align="center" label="Operaciones" width="170">
                    <template slot="header" slot-scope="scope">
                      <el-input
                        v-model="searchEstadoAccion"
                        size="mini"
                        placeholder="Buscar Estado"/>
                    </template>
                    <template slot-scope="scope">
                          <el-button circle icon="el-icon-edit" size="mini" type="primary" @click="handleEditEstadoAccion(scope.$index, scope.row)"></el-button>
                          <el-button v-if="(scope.row.acciones).length ==0" circle size="mini" type="danger" icon="el-icon-delete" @click="handleDeleteEstadoAccion(scope.$index, scope.row)"></el-button>
                    </template>
                </el-table-column>
            </el-table>
          </div>
      </div>
    </div>
@include('panel.registros.estadoAccionTarea.createEstadoAccion')
@include('panel.registros.estadoAccionTarea.createEstadoTarea')
@include('panel.registros.estadoAccionTarea.editEstadoTarea')
@include('panel.registros.estadoAccionTarea.editEstadoAccion')
</div>
@section('script')
{!!Html::script('js/estadoTareaAccion.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop