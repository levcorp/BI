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
        <el-table :data="usuarios" style="width: 100%">
            <el-table-column align="center" prop="id" label="#" width="180"></el-table-column>
            <el-table-column align="center" prop="nombre" label="Nombre" width="180"></el-table-column>
            <el-table-column align="center" prop="apellido" label="Apellido" width="180"></el-table-column>
            <el-table-column align="center" prop="email" label="Correo Electronico" width="180"></el-table-column>
            <el-table-column align="center" label="Operaciones">
              <template slot-scope="scope">
                <el-button
                  size="small"
                  circle
                  type="warning"
                  icon="el-icon-view"
                  @click="handleModulo(scope.$index, scope.row)">
                </el-button>
                  <el-button
                  size="small"
                  circle
                  type="primary"
                  icon="el-icon-setting"
                  @click="handleModulo(scope.$index, scope.row)">
                </el-button>
              </template>
            </el-table-column>
        </el-table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  @include('panel.registros.usuarios.modulos')
  @include('panel.registros.usuarios.wrx')
</div>
@section('script')
{!!Html::script('js/usuarios.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop