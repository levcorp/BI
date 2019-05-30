@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row">
  <div class="col-sm-6" id="lp">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">GPOS La Paz</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <el-row slot="tool" style="margin: 5px 0">
          <form method="POST" @submit.prevent="generar">
              <div class="col-sm-5 col-xs-6" style="margin: 5px 0">
                <div class="pull-right">
                <v-date-picker
                locale="es"
                  mode='range'
                  v-model='selectedDate'
                  show-caps>
                  </v-date-picker>
                </div>
              </div>
              <div class="col-sm-3 col-xs-6" style="margin: 5px 0">
                <div class="pull-left">
                  <el-button native-type="submit" type="primary"><i class="el-icon-finished"></i></el-button>
                </div>
              </div>
          </form>
            <div class="col-sm-4 col-xs-12" style="margin: 5px 0">
              <el-input v-model="filters[0].value" placeholder="Buscar"></el-input>
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
          <h3 class="box-title">GPOS Cochabamba</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <el-row slot="tool" style="margin: 5px 0">
              <form method="POST" @submit.prevent="generar">
              <div class="col-sm-5 col-xs-6" style="margin: 5px 0">
                <div class="pull-right">
                <v-date-picker
                locale="es"
                  mode='range'
                  v-model='selectedDate'
                  show-caps>
                  </v-date-picker>
                </div>
              </div>
              <div class="col-sm-3 col-xs-6" style="margin: 5px 0">
                <div class="pull-left">
                  <el-button native-type="submit" type="primary"><i class="el-icon-finished"></i></el-button>
                </div>
              </div>
          </form>
            <div class="col-sm-4 col-xs-12" style="margin: 5px 0">
              <el-input v-model="filters[0].value" placeholder="Buscar"></el-input>
            </div>
          </el-row>
          <data-tables  :filters="filters" :data="archivosCO" :table-props="table" :page-size="5" :pagination-props="{ pageSizes: [5, 10, 15,20] }" :action-col="dowload">
              <el-table-column v-for="title in titles" :prop="title.prop" :label="title.label" :key="title.label" sortable="custom">
              </el-table-column>
          </data-tables>
        </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6" id="sc">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">GPOS Santa Cruz</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <el-row slot="tool" style="margin: 5px 0">
              <form method="POST" @submit.prevent="generar">
              <div class="col-sm-5 col-xs-6" style="margin: 5px 0">
                <div class="pull-right">
                <v-date-picker
                locale="es"
                  mode='range'
                  v-model='selectedDate'
                  show-caps>
                  </v-date-picker>
                </div>
              </div>
              <div class="col-sm-3 col-xs-6" style="margin: 5px 0">
                <div class="pull-left">
                  <el-button native-type="submit" type="primary"><i class="el-icon-finished"></i></el-button>
                </div>
              </div>
          </form>
            <div class="col-sm-4 col-xs-12" style="margin: 5px 0">
              <el-input v-model="filters[0].value" placeholder="Buscar"></el-input>
            </div>
          </el-row>
          <data-tables  :filters="filters" :data="archivosSC" :table-props="table" :page-size="5" :pagination-props="{ pageSizes: [5, 10, 15,20] }" :action-col="dowload">
              <el-table-column v-for="title in titles" :prop="title.prop" :label="title.label" :key="title.label" sortable="custom">
              </el-table-column>
          </data-tables>
        </div>
      <!-- /.box-body -->
    </div>
  </div>
  <div class="col-sm-6" id="general">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">GPOS General</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <el-row slot="tool" style="margin: 5px 0">
              <form method="POST" @submit.prevent="generar">
              <div class="col-sm-5 col-xs-6" style="margin: 5px 0">
                <div class="pull-right">
                <v-date-picker
                locale="es"
                  mode='range'
                  v-model='selectedDate'
                  show-caps>
                  </v-date-picker>
                </div>
              </div>
              <div class="col-sm-3 col-xs-6" style="margin: 5px 0">
                <div class="pull-left">
                  <el-button native-type="submit" type="primary"><i class="el-icon-finished"></i></el-button>
                </div>
              </div>
          </form>
              <div class="col-sm-4 col-xs-12" style="margin: 5px 0">
                <el-input v-model="filters[0].value" placeholder="Buscar"></el-input>
              </div>
          </el-row>
          <data-tables  v-loading="loading" :filters="filters" :data="archivosGEN" :table-props="table" :page-size="5" :pagination-props="{ pageSizes: [5, 10, 15,20] }" :action-col="dowload">
              <el-table-column v-for="title in titles" :prop="title.prop" :label="title.label" :key="title.label" sortable="custom">
              </el-table-column>
          </data-tables>
        </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>

  <!-- /.col -->
@section('script')
{!!Html::script('js/gpos.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">

@endsection
@stop