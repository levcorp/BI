@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row">
  <div class="col-sm-6" id="lp">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">EDI SANTA CRUZ</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <el-row slot="tool" style="margin: 5px 0">
            <div class="col-sm-4 col-xs-6" style="margin: 5px 0">
                <div class="pull-left">
                  <input type="date" class="el-input__inner" v-model="date" @keyup.enter="dateEDI" :max="new Date().toISOString().slice(0, 10)">
                </div>
            </div>
            <div class="col-sm-3 col-xs-6" style="margin: 5px 0">
                <div class="pull-left">
                <el-button @click="dateEDI()" type="primary"><i class="fa fa-arrow-circle-right"></i></el-button>
                </div>
            </div>
             <div class="col-sm-5 col-xs-12" style="margin: 5px 0">
                <el-input v-model="search" placeholder="Buscar"></el-input>
            </div>
        </el-row>
        <el-table highlight-current-row :data="archivosLP.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))" style="width: 100%" height="320" :default-sort = "{prop: 'name', order: 'descending'}" >
            <el-table-column align="center" label="Archivo" prop="name" sortable ></el-table-column>
            <el-table-column align="center" label="Fecha" prop="fecha" sortable ></el-table-column>
             <el-table-column align="center" label="Operaciones">
              <template slot-scope="scope">
                <el-button
                  size="small"
                  type="warning"
                  icon="el-icon-download"
                  circle
                  @click="handleDownload(scope.$index, scope.row)"></el-button>
                <el-button
                  size="small"
                  type="primary"
                  icon="el-icon-zoom-in"
                  circle
                  @click="handleTable(scope.$index, scope.row)"></el-button>
              </template>
            </el-table-column>
        </el-table>
      </div>
      <!-- /.box-body -->
    </div>
    @include('panel.registros.edi.detalleLP')
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
          <div class="col-sm-4 col-xs-6" style="margin: 5px 0">
                <div class="pull-left">
                  <input type="date" class="el-input__inner" v-model="date" @keyup.enter="dateEDI" :max="new Date().toISOString().slice(0, 10)">
                </div>
            </div>
            <div class="col-sm-3 col-xs-6" style="margin: 5px 0">
                <div class="pull-left">
                <el-button @click="dateEDI()" type="primary"><i class="fa fa-arrow-circle-right"></i></el-button>
                </div>
            </div>
             <div class="col-sm-5 col-xs-12" style="margin: 5px 0">
                <el-input v-model="search" placeholder="Buscar"></el-input>
            </div>
        </el-row>
       <el-table highlight-current-row :data="archivosCO.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))" style="width: 100%" height="320" :default-sort = "{prop: 'name', order: 'descending'}" >
            <el-table-column align="center" label="Archivo" prop="name" sortable ></el-table-column>
            <el-table-column align="center" label="Fecha" prop="fecha" sortable ></el-table-column>
             <el-table-column align="center" label="Operaciones">
              <template slot-scope="scope">
                <el-button
                  size="small"
                  circle
                  type="warning"
                  icon="el-icon-download"
                  @click="handleDownload(scope.$index, scope.row)"></el-button>
                <el-button
                  size="small"
                  type="primary"
                  icon="el-icon-zoom-in"
                  circle
                  @click="handleTable(scope.$index, scope.row)"></el-button>
              </template>
            </el-table-column>
        </el-table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
    @include('panel.registros.edi.detalleCO')
  </div>
</div>
<div class="row">
  <div class="col-sm-6" id=sc>
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">EDI HUB</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
         <el-row slot="tool" style="margin: 5px 0">
              <div class="col-sm-4 col-xs-6" style="margin: 5px 0">
                <div class="pull-left">
                  <input type="date" class="el-input__inner" v-model="date" @keyup.enter="dateEDI" :max="new Date().toISOString().slice(0, 10)">
                </div>
            </div>
            <div class="col-sm-3 col-xs-6" style="margin: 5px 0">
                <div class="pull-left">
                <el-button @click="dateEDI()" type="primary"><i class="fa fa-arrow-circle-right"></i></el-button>
                </div>
            </div>
             <div class="col-sm-5 col-xs-12" style="margin: 5px 0">
                <el-input v-model="search" placeholder="Buscar"></el-input>
            </div>
        </el-row>
        <el-table highlight-current-row :data="archivosSC.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))" style="width: 100%" height="320" :default-sort = "{prop: 'name', order: 'descending'}" >
            <el-table-column align="center" label="Archivo" prop="name" sortable ></el-table-column>
            <el-table-column align="center" label="Fecha" prop="fecha" sortable ></el-table-column>
             <el-table-column align="center" label="Operaciones">
              <template slot-scope="scope">
                <el-button
                  size="small"
                  circle
                  type="warning"
                  icon="el-icon-download"
                  @click="handleDownload(scope.$index, scope.row)"></el-button>
                <el-button
                  size="small"
                  type="primary"
                  icon="el-icon-zoom-in"
                  circle
                  @click="handleTable(scope.$index, scope.row)"></el-button>
              </template>
            </el-table-column>
        </el-table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
    @include('panel.registros.edi.detalleSC')
  </div>
  <div class="col-sm-6" id=hub>
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">EDI LA PAZ</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
         <el-row slot="tool" style="margin: 5px 0">
              <div class="col-sm-4 col-xs-6" style="margin: 5px 0">
                <div class="pull-left">
                  <input type="date" class="el-input__inner" v-model="date" @keyup.enter="dateEDI" :max="new Date().toISOString().slice(0, 10)">
                </div>
            </div>
            <div class="col-sm-3 col-xs-6" style="margin: 5px 0">
                <div class="pull-left">
                <el-button @click="dateEDI()" type="primary"><i class="fa fa-arrow-circle-right"></i></el-button>
                </div>
            </div>
             <div class="col-sm-5 col-xs-12" style="margin: 5px 0">
                <el-input v-model="search" placeholder="Buscar"></el-input>
            </div>
        </el-row>
        <el-table highlight-current-row :data="archivosHUB.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))" style="width: 100%" height="320" :default-sort = "{prop: 'name', order: 'descending'}" >
            <el-table-column align="center" label="Archivo" prop="name" sortable ></el-table-column>
            <el-table-column align="center" label="Fecha" prop="fecha" sortable ></el-table-column>
             <el-table-column align="center" label="Operaciones">
              <template slot-scope="scope">
                <el-button
                  size="small"
                  circle
                  type="warning"
                  icon="el-icon-download"
                  @click="handleDownload(scope.$index, scope.row)"></el-button>
                <el-button
                  size="small"
                  type="primary"
                  circle
                  icon="el-icon-zoom-in"
                  @click="handleTable(scope.$index, scope.row)"></el-button>
              </template>
            </el-table-column>
        </el-table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
    @include('panel.registros.edi.detalleHUB')
  </div>
</div>
  <!-- /.col -->

@section('script')
{!!Html::script('js/edi.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop