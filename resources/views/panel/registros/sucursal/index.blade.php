@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app">
  <div class="col-xs-12">
    <div class="box box-info">
        <div class="box-header">
          <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <h3 class="box-title">Sucursales Registradas</h3>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <div class="pull-right" style="margin-right: 10px">
                    <el-button
                    size="medium"
                    type="primary"
                    icon="el-icon-plus"
                    plain
                    @click="handleCreate()"
                    >Crear Perfil
                    </el-button>
                  </div>
              </div>
          </div>
        </div>
        <div class="box-body">
          <el-table :data="sucursales.filter(data => !search || data.nombre.toLowerCase().includes(search.toLowerCase())|| data.ciudad.toLowerCase().includes(search.toLowerCase()))" style="width: 100%" height="450" highlight-current-row>
              <el-table-column width="70" align="center" label="#">
                <template slot-scope="scope">
                  <i class="el-icon-caret-right"></i>
                  <span style="margin-left: 10px">@{{ scope.row.id }}</span>
                </template>
              </el-table-column>
              <el-table-column align="center" prop="nombre" label="Nombre"></el-table-column>
              <el-table-column align="center" prop="ciudad" label="Ciudad"></el-table-column>
              <el-table-column align="center" prop="telefono" label="Telefono"></el-table-column>
              <el-table-column align="center" prop="fax" label="Fax"></el-table-column>
              <el-table-column align="center" prop="correo" label="Correo"></el-table-column>
              <el-table-column align="center" label="Operaciones" width="180">
                  <template slot="header" slot-scope="scope">
                    <el-input
                      v-model="search"
                      size="mini"
                      placeholder="Buscar Sucursal"/>
                  </template>
                  <template slot-scope="scope">
                          <el-button circle icon="el-icon-plus" size="mini" type="warning" @click="handleShow(scope.$index, scope.row)"></el-button>
                          <el-button circle icon="el-icon-edit" size="mini" type="primary" @click="handleEdit(scope.$index, scope.row)"></el-button>
                          <el-button circle size="mini" type="danger" icon="el-icon-delete" @click="handleDelete(scope.$index, scope.row)"></el-button>
                  </template>
              </el-table-column>
          </el-table>
        </div>
    </div>
    @include('panel.registros.sucursal.create')
    @include('panel.registros.sucursal.show')
    @include('panel.registros.sucursal.edit')
  </div>
</div>
@section('script')
{!!Html::script('js/sucursal.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop