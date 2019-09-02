@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app" v-cloak>
  <div class="col-xs-12">
    <div class="box box-info">
        <div class="box-header">
          <div class="row">
              <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                  <h3 class="box-title">Renovar certificado</h3>
              </div>
              <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                <div class="pull-right" style="margin-right: 10px">
                  <el-button
                  v-if="sistema.ssl==1"
                  size="mini"
                  type="danger"
                  icon="el-icon-remove"
                  @click="handleRemodeOrAddSSL()"
                  >Quitar SSL
                  </el-button>
                </div>
                <div class="pull-right" style="margin-right: 10px">
                  <el-button
                  v-if="sistema.ssl==0"
                  size="mini"
                  type="success"
                  icon="el-icon-check"
                  @click="handleRemodeOrAddSSL()"
                  >Activar SSL
                  </el-button>
                </div>
              </div>
              <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                  <div class="pull-right" style="margin-right: 10px">
                    <el-button
                    size="mini"
                    type="primary"
                    icon="el-icon-plus"
                    @click="handleNew()"
                    >Nuevo Codigo
                    </el-button>
                  </div>
              </div>
          </div>
        </div>
        <div class="box-body">
            <el-table :data="data" style="width: 100%" height="450" highlight-current-row>
                <el-table-column width="70" align="center" prop="id" label="#"></el-table-column>
                <el-table-column align="center" prop="link" label="Codigo"></el-table-column>
                <el-table-column align="center" prop="resp" label="Respuesta"></el-table-column>
                <el-table-column align="center" label="Operaciones" width="180">
                    <template slot-scope="scope">
                        <el-button circle size="mini" v-if="scope.row.estado==1" type="danger" icon="el-icon-delete" @click="handleDelete(scope.$index, scope.row)"></el-button>
                        <el-button circle size="mini" v-if="scope.row.estado==0" type="success" icon="el-icon-folder" @click="handleSubmit(scope.$index, scope.row)"></el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>
    </div>
  </div>
  @include('panel.ssl.new')
  @include('panel.ssl.submit')
</div>
@section('script')
{!!Html::script('js/ssl.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop