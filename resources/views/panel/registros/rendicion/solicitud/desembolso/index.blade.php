@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app" v-cloak>
    <input type="text" v-model="values.sucursal_id='{{Auth::user()->sucursal_id}}'" hidden>
    <input type="text" v-model="values.usuario_id='{{Auth::user()->id}}'" hidden>
    <div class="col-sm-12">
        <div class="box box-info">
                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <p style="font-size: 15px">
                                <strong>
                                    Solicitud de Fondos en Procesamiento
                                </strong>
                            </p>
                        </div>
                    </div>
                </div>
              <div class="box-body">
                  <el-table v-loading="loading" :data="data.solicitudes.procesamiento" max-height="250" style="width: 100%"  highlight-current-row>
                      <el-table-column width="120" align="center" label="Nº Documento">
                          <template slot-scope="scope">
                              <span style="margin-top-left: 10px">@{{ scope.row.id }}</span>
                          </template>
                      </el-table-column>
                      <el-table-column align="center" width="120" label="Solicitado">
                        <template slot-scope="scope">
                            @{{scope.row.solicitado.nombre+' '+scope.row.solicitado.apellido}}
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
                              <el-tag type="danger" size="medium">Procesamiento</el-tag>
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
                            <el-dropdown @command="handleCommandSolicitudProcesada">
                              <el-button type="primary" size="mini">
                                Opciones<i class="el-icon-arrow-down el-icon--right"></i>
                              </el-button>
                              <el-dropdown-menu slot="dropdown">
                                <el-dropdown-item :command="{type:'desembolso',solicitud:scope.row}">Por Desembolsar</el-dropdown-item>
                                <el-dropdown-item :command="{type:'reporte',solicitud:scope.row}">Reporte</el-dropdown-item>
                                <el-dropdown-item :command="{type:'show',solicitud:scope.row}">Detalle</el-dropdown-item>
                              </el-dropdown-menu>
                            </el-dropdown>
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
                                    Solicitud de Fondos Desembolsadas
                                </strong>
                            </p>
                        </div>
                    </div>
                </div>
              <div class="box-body">
                  <el-table v-loading="loading" :data="data.solicitudes.desembolsado" max-height="250" style="width: 100%"  highlight-current-row>
                      <el-table-column width="120" align="center" label="Nº Documento">
                          <template slot-scope="scope">
                              <span style="margin-top-left: 10px">@{{ scope.row.id }}</span>
                          </template>
                      </el-table-column>
                      <el-table-column align="center" width="120" label="Solicitado">
                        <template slot-scope="scope">
                            @{{scope.row.solicitado.nombre+' '+scope.row.solicitado.apellido}}
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
                              <el-tag type="success" size="medium">Por Desembolsar</el-tag>
                        </template>
                      </el-table-column>
                      <el-table-column align="center" prop="IMPORTE_SOLICITADO" label="Importe Solicitado"></el-table-column>
                      <el-table-column align="center" label="Acciones" width="180">
                          <template slot-scope="scope">
                              <el-dropdown @command="handleCommandSolicitudDesembolsado">
                                <el-button type="primary" size="mini">
                                  Opciones<i class="el-icon-arrow-down el-icon--right"></i>
                                </el-button>
                                <el-dropdown-menu slot="dropdown">
                                  <el-dropdown-item :command="{type:'reporte',solicitud:scope.row}">Reporte</el-dropdown-item>
                                  <el-dropdown-item :command="{type:'show',solicitud:scope.row}">Detalle</el-dropdown-item>
                                </el-dropdown-menu>
                              </el-dropdown>
                          </template>
                      </el-table-column>
                  </el-table>
              </div>
        </div>
        @include('panel.registros.rendicion.solicitud.show')
        @include('panel.registros.rendicion.solicitud.desembolso.desembolso')
    </div>
</div>
@section('script')
{!!Html::script('js/tesoreria.js')!!}
@endsection
@stop
