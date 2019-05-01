@extends('layouts.usuarios')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app">
  <div class="col-xs-12">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">EDIS Generados</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <el-row slot="tool" style="margin: 10px 0">
            <el-col :span="5">
                <el-button @click="generar" type="primary">Generar  <i class="el-icon-files"></i></el-button>
            </el-col>
            <el-col :span="10">
            </el-col>
            <el-col :span="5" :offset="4">
                <el-input v-model="filters[0].value">
                </el-input>
            </el-col>
        </el-row>
        <data-tables  :filters="filters" :data="archivosLP" :table-props="table" :pagination-props="{ pageSizes: [5, 10, 15] }" :action-col="dowload">
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
{!!Html::script('js/edi.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop