@extends('layouts.table')
@section('style')
<style>
.el-table th{
  background-color: rgba(0,0,0,0) !important;
}
</style>

@endsection
@section('titulo')
@endsection
@section('contenido')
  <div class="row" id="app" v-cloak>
      <input type="text" v-model="values.sucursal_id='{{Auth::user()->sucursal->ciudad}}'" hidden>
      <div class="col-sm-12">
          <div class="box box-info" style="">
              <div class="box-header">
                  <div class="row">
                        <div class="col-sm-4 col-md-4 col-lg-4 col-6">
                          <p style="font-size: 15px">
                              <strong>&nbsp;&nbsp;  Seguimiento de Ordenes de Venta</strong>
                          </p>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 col-6">
                            <el-button-group >
                                <el-button @click="handleGetSucursal('LP')" round size="mini" type="primary" icon="el-icon-search">La Paz</el-button>
                                <el-button @click="handleGetSucursal('CO')" round size="mini" type="primary" icon="el-icon-search">Cochabamaba</el-button>
                                <el-button @click="handleGetSucursal('SC')" round size="mini" type="primary" icon="el-icon-search">Santa Cruz</el-button>
                            </el-button-group>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 col-12">
                            <div class="pull-right" style="margin-right: 10px">
                              <el-button :loading="loading.export" size="mini" @click="handleExportSeguimiento()" type="primary" icon="el-icon-notebook-2" round> Exportar Lista</el-button>
                            </div>
                        </div>
                    </div>
              </div>
              <div class="box-body">
                  <el-table v-loading="loading.datos" :header-row-style="headerRowStyleDatos" :data="datos" style="width: 100%" height="420" highlight-current-row>
                      <el-table-column align="center" width="50" fixed="left">
                            <template slot-scope="scope">
                                <el-button v-if="scope.row.PROCESADO=='SI'" @click="handleGetDetalle(scope.row)" icon="el-icon-plus" circle size="mini" type="primary"></el-button>
                            </template>
                        </el-table-column>
                      <el-table-column align="center" label="#"  width="70">
                          <template slot-scope="scope">
                              <p style="font-size: 12px;">
                                    @{{scope.$index + 1}}
                              </p>
                          </template>
                      </el-table-column>
                      <el-table-column align="center" prop="OV_COD_SAP" label="COD SAP" sortable width="130">
                          <template slot-scope="scope">
                              <p style="font-size: 12px;">
                                  <strong>
                                      @{{scope.row.OV_COD_SAP}}
                                  </strong>
                              </p>
                          </template>
                      </el-table-column>
                      <el-table-column align="center" label="NOM. CLIENTE" sortable width="200">
                          <template slot-scope="scope">
                              <p style="font-size: 12px;">
                                  <strong>
                                      @{{scope.row.OV_NOM_CLIENTE}}
                                  </strong>
                              </p>
                          </template>
                      </el-table-column>
                      <el-table-column align="center" label="PROCESADO" sortable width="130">
                          <template slot-scope="scope">
                                <el-tag
                                    :type="scope.row.PROCESADO=='SI'? 'success':'danger'"
                                    effect="light"
                                    size="mini">
                                    @{{scope.row.PROCESADO}}
                                </el-tag>
                          </template>
                      </el-table-column>
                      <el-table-column align="center" label="TIPO" sortable width="110">
                          <template slot-scope="scope">
                                <el-tag
                                :type="scope.row.TIPO=='BTB'? 'primary':scope.row.TIPO=='NBTB'?'warning':'danger'"
                                effect="light"
                                size="mini">
                                @{{scope.row.TIPO}}
                            </el-tag>
                              </p>
                          </template>
                      </el-table-column>
                      <el-table-column align="center" label="PICKING" sortable width="120">
                          <template slot-scope="scope">
                              <p style="font-size: 12px;">
                                  @{{scope.row.PICKING}}
                              </p>
                          </template>
                      </el-table-column>
                      <el-table-column align="center" label="PEND. FACT." sortable width="120">
                          <template slot-scope="scope">
                              <p style="font-size: 12px;">
                                      @{{scope.row.PENDIENTE_FACTURACION}}
                              </p>
                          </template>
                      </el-table-column>
                      <el-table-column align="center" label="FECHA ENTREGA" sortable width="160">
                          <template slot-scope="scope">
                              <p style="font-size: 12px;">
                                <strong>
                                  @{{scope.row.OV_FEC_ENTREGA | moment("Y-MM-DD") }}
                                </strong>
                              </p>
                          </template>
                      </el-table-column>
                      <el-table-column align="center" label="COMENTARIOS" sortable width="350">
                          <template slot-scope="scope">
                              <p style="font-size: 11px;">
                                    @{{scope.row.OV_COMENTARIOS ? scope.row.OV_COMENTARIOS:'SIN COMENTARIO'}}
                              </p>
                          </template>
                      </el-table-column>
                  </el-table>
              </div>
          </div>
      </div>
      @include('panel.registros.seguimiento.detalle')
  </div>
@section('script')
{!!Html::script('js/seguimiento.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop