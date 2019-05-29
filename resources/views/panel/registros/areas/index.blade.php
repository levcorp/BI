@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app">
  <div class="col-xs-12">
    <div class="box box-info">
       <div class="box-header">
         <h3 class="box-title">Areas Registradas</h3>
       </div>
      <!-- /.box-header -->
        <el-table :data="areas" style="width: 100%">
            <el-table-column prop="date" label="Titulo" width="180"></el-table-column>
            <el-table-column prop="name" label="Descripción" width="180"></el-table-column>
            <el-table-column label="estado">
                <template slot-scope="scope">
                    <el-tag :type="scope.row.estado === 1 ? 'primary' : 'success'" disable-transitions>@{{scope.row.estado}}</el-tag>
                </template>
            </el-table-column>
            <el-table-column label="Operaciones">
                <template slot-scope="scope">
                    <el-button size="mini" @click="handleEdit(scope.$index, scope.row)">Editar</el-button>
                    <el-button size="mini" type="danger" @click="handleDelete(scope.$index, scope.row)">Eliminar</el-button>
                </template>
            </el-table-column>
        </el-table>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
@section('script')
{!!Html::script('js/areas.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop