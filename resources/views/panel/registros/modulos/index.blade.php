@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="modulo">
  <div class="col-xs-12">
    <div class="box box-info">
       <div class="box-header">
         <h3 class="box-title">Modulos Registrados</h3>
       </div>
      <!-- /.box-header -->
        <el-table :data="modulos" style="width: 100%">
            <el-table-column prop="date" label="Titulo" width="180"></el-table-column>
            <el-table-column prop="name" label="Descripción" width="180"></el-table-column>
        </el-table>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
@section('script')
{!!Html::script('js/modulo.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop