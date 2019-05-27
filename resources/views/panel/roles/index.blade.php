@extends('layouts.usuarios')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="rol">
  <div class="col-xs-12">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">Roles Registrados</h3>
      </div>
      <!-- /.box-header -->
        <el-table
            :data="roles"
            style="width: 100%"
            >
            <el-table-column
            label="ID"
            align="center"
            width="100">
            <template slot-scope="scope">
                <i class="el-icon-time"></i>
                <span style="margin-left: 10px">@{{ scope.row.id }}</span>
            </template>
            </el-table-column>
            <el-table-column
            property="titulo"
            label="Nombre de Rol"
            align="center">
            </el-table-column>
            <el-table-column
            label="Descripcion"            
            property="descripcion" align="center">
            </el-table-column>
        </el-table>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
@section('script')
{!!Html::script('js/rol.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop