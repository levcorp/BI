@extends('layouts.usuarios')
@section('titulo')
@endsection
@section('contenido')
<div class="row">
  <div class="col-sm-6" id="lp">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">EDI LA PAZ</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <el-row slot="tool" style="margin: 5px 0">
            <div class="col-sm-3 col-xs-6" style="margin: 5px 0">
                <el-button @click="generar" type="primary">Generar  <i class="el-icon-files"></i></el-button>
            </div>
            <div class="col-sm-4 col-xs-6" style="margin: 5px 0">
                <el-input v-model="filters[0].value" placeholder="Buscar"></el-input>
            </div>
             <div class="col-sm-5 col-xs-12" style="margin: 5px 0">
                  <input type="date" class="el-input__inner" v-model="date" @keyup.enter="dateEDI" :max="new Date().toISOString().slice(0, 10)">
            </div>
        </el-row>
        <data-tables  :filters="filters" :data="archivosLP" :table-props="table" :page-size="5" :pagination-props="{ pageSizes: [5, 10, 15,20] }" :action-col="dowload">
            <el-table-column v-for="title in titles" :prop="title.prop" :label="title.label" :key="title.label" sortable="custom">
            </el-table-column>
        </data-tables>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <div class="col-sm-6" id="co">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">EDI COCHABAMBA</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
         <el-row slot="tool" style="margin: 5px 0">
            <div class="col-sm-3 col-xs-6" style="margin: 5px 0">
                <el-button @click="generar" type="primary">Generar  <i class="el-icon-files"></i></el-button>
            </div>
            <div class="col-sm-4 col-xs-6" style="margin: 5px 0">
                <el-input v-model="filters[0].value" placeholder="Buscar"></el-input>
            </div>
             <div class="col-sm-5 col-xs-12" style="margin: 5px 0">
                  <input type="date" class="el-input__inner" v-model="date" @keyup.enter="dateEDI" :max="new Date().toISOString().slice(0, 10)">
            </div>
        </el-row>
        <data-tables  :filters="filters" :data="archivosCO" :table-props="table" :page-size="5" :pagination-props="{ pageSizes: [5, 10, 15,20] }" :action-col="dowload">
            <el-table-column v-for="title in titles" :prop="title.prop" :label="title.label" :key="title.label" sortable="custom">
            </el-table-column>
        </data-tables>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
<div class="row">
  <div class="col-sm-6" id=sc>
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">EDI SANTA CRUZ</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
         <el-row slot="tool" style="margin: 5px 0">
            <div class="col-sm-3 col-xs-6" style="margin: 5px 0">
                <el-button @click="generar" type="primary">Generar  <i class="el-icon-files"></i></el-button>
            </div>
            <div class="col-sm-4 col-xs-6" style="margin: 5px 0">
                <el-input v-model="filters[0].value" placeholder="Buscar"></el-input>
            </div>
             <div class="col-sm-5 col-xs-12" style="margin: 5px 0">
                  <input type="date" class="el-input__inner" v-model="date" @keyup.enter="dateEDI" :max="new Date().toISOString().slice(0, 10)">
            </div>
        </el-row>
        <data-tables  :filters="filters" :data="archivosSC" :table-props="table"  :page-size="5" :pagination-props="{ pageSizes: [5, 10, 15,20] }" :action-col="dowload">
            <el-table-column v-for="title in titles" :prop="title.prop" :label="title.label" :key="title.label" sortable="custom">
            </el-table-column>
        </data-tables>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <div class="col-sm-6" id=hub>
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">EDI HUB</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
         <el-row slot="tool" style="margin: 5px 0">
            <div class="col-sm-3 col-xs-6" style="margin: 5px 0">
                <el-button @click="generar" type="primary">Generar  <i class="el-icon-files"></i></el-button>
            </div>
            <div class="col-sm-4 col-xs-6" style="margin: 5px 0">
                <el-input v-model="filters[0].value" placeholder="Buscar"></el-input>
            </div>
             <div class="col-sm-5 col-xs-12" style="margin: 5px 0">
                  <input type="date" class="el-input__inner" v-model="date" @keyup.enter="dateEDI" :max="new Date().toISOString().slice(0, 10)">
            </div>
        </el-row>
        <data-tables  :filters="filters" :data="archivosHUB" :table-props="table" :page-size="5" :pagination-props="{ pageSizes: [5, 10, 15,20] }" :action-col="dowload">
            <el-table-column v-for="title in titles" :prop="title.prop" :label="title.label" :key="title.label" sortable="custom">
            </el-table-column>
        </data-tables>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
  <!-- /.col -->

@section('script')
{!!Html::script('js/edi.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop