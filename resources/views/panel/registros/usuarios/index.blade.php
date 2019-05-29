@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app">
  <div class="col-xs-12">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">Usuarios Registrados</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
          <data-tables :data="usuarios" :pagination-props="{ pageSizes: [5, 10, 15] }">
              | <el-table-column v-for="title in titles" :prop="title.prop" :label="title.label" :key="title.label" sortable="custom">
              </el-table-column>
          </data-tables>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
@section('script')
{!!Html::script('js/usuarios.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop