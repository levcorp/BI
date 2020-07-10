@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app" v-cloak>
    <input type="text" v-model="values.sucursal_id='{{Auth::user()->sucursal_id}}'" hidden>
    <input type="text" v-model="values.usuario_id='{{Auth::user()->id}}'" hidden>
    <template v-if="show.index">
      <div class="col-sm-12">
          <div class="box box-info">
                  <div class="box-header">
                      <div class="row">
                          <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                              <p style="font-size: 15px">
                                  <strong>
                                      Rendiciones de Fondos No Aprobadas
                                  </strong>
                              </p>
                          </div>
                      </div>
                  </div>
                <div class="box-body">
                    <el-table v-loading="loading" :data="data.rendiciones.noautorizado" max-height="250" style="width: 100%"  highlight-current-row>
                        <el-table-column width="70" align="center" label="#">
                            <template slot-scope="scope">
                                <span style="margin-top-left: 10px">@{{ scope.row.id }}</span>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="FECHA_SOLICITUD" label="Fecha Solicitud">
                          <template slot-scope="scope">
                              @{{scope.row.FECHA_SOLICITUD | moment("Y-M-D")}}
                          </template>
                        </el-table-column>
                        <el-table-column align="center" prop="FECHA_DESEMBOLSO" label="Fecha Desembolso">
                          <template slot-scope="scope">
                              @{{scope.row.FECHA_DESEMBOLSO | moment("Y-M-D")}}
                          </template>
                        </el-table-column>
                        <el-table-column align="center" prop="DESCRIPCION" label="Descripcion"></el-table-column>
                        <el-table-column align="center" prop="ESTADO" label="Estado">
                          <template slot-scope="scope">
                                <el-tag type="danger" size="medium">No Aprobadas</el-tag>
                          </template>
                        </el-table-column>
                        <el-table-column align="center" label="Tipo">
                          <template slot-scope="scope">
                              <div slot="reference" class="name-wrapper" v-if="scope.row.URGENTE==1">
                                <el-tag type="primary" size="medium">Urgente</el-tag>
                              </div>
                              <div slot="reference" class="name-wrapper" v-else="scope.row.URGENTE==0">
                                <el-tag type="success" size="medium">Normal</el-tag>
                              </div>
                          </template>
                        </el-table-column>
                        <el-table-column align="center" label="Acciones" width="180">
                            <template slot-scope="scope">
                                <el-button circle size="mini" type="success" icon="el-icon-notebook-2" @click="handleAutorizarSolicitud(scope.$index, scope.row)"></el-button>
                                <el-button circle size="mini" type="warning" icon="el-icon-plus" @click="handleShowSolicitud(scope.$index, scope.row)"></el-button>
                                <el-button circle size="mini" type="primary" icon="el-icon-document-checked" @click="handleRendicionViaticos(scope.$index, scope.row)"></el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
          </div>
      </div>
      <div class="col-sm-12">
          <div class="box box-info">
                  <div class="box-header">
                      <div class="row">
                          <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                              <p style="font-size: 15px">
                                  <strong>
                                      Rendiciones de Fondos Aprobadas
                                  </strong>
                              </p>
                          </div>
                      </div>
                  </div>
                <div class="box-body">
                    <el-table v-loading="loading" :data="data.rendiciones.autorizado" max-height="250" style="width: 100%"  highlight-current-row>
                        <el-table-column width="70" align="center" label="#">
                            <template slot-scope="scope">
                                <span style="margin-top-left: 10px">@{{ scope.row.id }}</span>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="FECHA_SOLICITUD" label="Fecha Solicitud">
                          <template slot-scope="scope">
                              @{{scope.row.FECHA_SOLICITUD | moment("Y-M-D")}}
                          </template>
                        </el-table-column>
                        <el-table-column align="center" prop="FECHA_DESEMBOLSO" label="Fecha Desembolso">
                          <template slot-scope="scope">
                              @{{scope.row.FECHA_DESEMBOLSO | moment("Y-M-D")}}
                          </template>
                        </el-table-column>
                        <el-table-column align="center" prop="DESCRIPCION" label="Descripcion"></el-table-column>
                        <el-table-column align="center" prop="ESTADO" label="Estado">
                          <template slot-scope="scope">
                                <el-tag type="success" size="medium">Aprobado</el-tag>
                          </template>
                        </el-table-column>
                        <el-table-column align="center" prop="IMPORTE_SOLICITADO" label="Importe Solicitado"></el-table-column>
                        <el-table-column align="center" label="Acciones" width="180">
                            <template slot-scope="scope">
                                <el-button circle size="mini" type="primary" icon="el-icon-notebook-2" @click="handleReporteSolicitud(scope.$index, scope.row)"></el-button>
                                <el-button circle size="mini" type="warning" icon="el-icon-plus" @click="handleShowSolicitud(scope.$index, scope.row)"></el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
          </div>
          @include('panel.registros.rendicion.solicitud.show')
      </div>
    </template>
    <template v-if="show.rendicion">
      <div class="col-sm-12">
        <div class="box box-info">
        @include('panel.registros.rendicion.viaticos.index')
        @include('panel.registros.rendicion.solicitud.autorizacionRendicion.rechazo')
        @include('panel.registros.rendicion.solicitud.autorizacionRendicion.aprobacion')
        </div>
      </div>
    </template>
</div>
@section('script')
{!!Html::script('js/autorizacionRendicion.js')!!}
@endsection
@stop
