@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="usuario">
  <div class="col-xs-12">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">Usuarios Registrados</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <el-table :data="usuarios.filter(data => !search || data.samaccountname[0].toLowerCase().includes(search.toLowerCase())|| data.cn[0].toLowerCase().includes(search.toLowerCase()))" style="width: 100%" height="450" >
            <el-table-column align="center" prop="givenname" label="Nombre" width="150"></el-table-column>
            <el-table-column align="center" prop="sn" label="Apellido" width="180"></el-table-column>
            <el-table-column align="center" prop="mail" label="Correo Electronico" width="180"></el-table-column>
            <el-table-column align="center" prop="mobile" label="Celular" width="100"></el-table-column>
            <el-table-column align="center" prop="department" label="Departamento" width="120"></el-table-column>
            <el-table-column align="center" prop="useraccountcontrol" label="Estado" width="110">
            <template slot-scope="scope">
                <div slot="reference" class="name-wrapper" v-if="scope.row.useraccountcontrol[0]==66048">
                  <el-tag type="success" size="medium">Habilitado</el-tag>
                </div>
                <div slot="reference" class="name-wrapper" v-else="scope.row.useraccountcontrol[0]==66050">
                  <el-tag type="danger" size="medium">Deshabilitado</el-tag>
                </div>
              </el-popover>
            </template>
            </el-table-column>
            <!---<el-table-column align="center" prop="memberof[0]" label="Miembro" width="180"></el-table-column>-->
            <el-table-column align="center" label="Operaciones" width="380">
              <template slot="header" slot-scope="scope">
                <el-input
                  v-model="search"
                  size="mini"
                  placeholder="Buscar Usuario"/>
              </template>
              <template slot-scope="scope">
                <el-button
                  size="medium"
                  type="success"
                  icon="el-icon-check"
                  circle
                  v-if="scope.row.useraccountcontrol[0]==66050"
                  @click="handleEstado(scope.$index, scope.row)">
                </el-button>
                <el-button
                  size="medium"
                  type="danger"
                  icon="el-icon-close"
                  circle
                  v-if="scope.row.useraccountcontrol[0]==66048"
                  @click="handleEstado(scope.$index, scope.row)">
                </el-button>
                <el-button
                  size="medium"
                  type="primary"
                  icon="el-icon-edit"
                  circle
                  @click="handleEdit(scope.$index, scope.row)">
                </el-button>
                <el-button
                  size="medium"
                  type="warning"
                  circle
                  icon="el-icon-view"
                  @click="handleShow(scope.$index, scope.row)">
                </el-button>
                <el-button
                  size="medium"
                  type="primary"
                  icon="el-icon-setting"
                  circle
                  @click="handleModulo(scope.$index, scope.row)">
                </el-button>
                <el-button
                  size="medium"
                  type="success"
                  icon="el-icon-lock"
                  circle
                  @click="handlePassword(scope.$index, scope.row)">
                </el-button>
              </template>
            </el-table-column>
        </el-table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
    @include('panel.registros.usuarios.wrx')
    @include('panel.registros.usuarios.edit')
    @include('panel.registros.usuarios.modulos')
    @include('panel.registros.usuarios.show')
  </div>
  <!-- /.col -->
</div>
@section('script')
{!!Html::script('js/usuarios.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop