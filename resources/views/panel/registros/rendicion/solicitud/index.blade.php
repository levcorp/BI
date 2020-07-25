@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app" v-cloak>
    <input type="text" v-model="values.sucursal_id='{{Auth::user()->sucursal_id}}'" hidden>
    <input type="text" v-model="values.usuario_id='{{Auth::user()->id}}'" hidden>
    <input type="text" v-model="values.objectguid='{{Auth::user()->objectguid}}'" hidden>
    <input type="text" v-model="values.cuenta='{{Auth::user()->cuenta_bancaria}}'" hidden>
    <div class="col-sm-12">
      {{QrCode::format('png')->generate('Embed me into an e-mail!')}}
        <div class="box box-info">
            <template v-if="show.index">
                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <p style="font-size: 15px">
                                <strong>
                                    Solicitud de Fondos Pendiente
                                </strong>
                            </p>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <div class="pull-right" style="margin-top-right: 10px">
                                <el-button
                                size="mini"
                                type="primary"
                                icon="el-icon-plus"
                                @click="handleCreateSolicitud()"
                                round
                                >Crear Solicitud de Fondos
                                </el-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <el-table v-loading="loading" :data="data.solicitudes.noaprobado" style="width: 100%" max-height="250" highlight-current-row>
                        <el-table-column width="120" align="center" label="Nº Documento">
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
                              <div slot="reference" class="name-wrapper" >
                                <el-tag type="danger" size="medium">Pendiente</el-tag>
                              </div>
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
                              <el-dropdown @command="handleCommandSolicitudPendiente">
                                <el-button type="primary" size="mini">
                                  Opciones<i class="el-icon-arrow-down el-icon--right"></i>
                                </el-button>
                                <el-dropdown-menu slot="dropdown">
                                  <el-dropdown-item :command="{type:'edit',pendiente:scope.row}">Editar</el-dropdown-item>
                                  <el-dropdown-item :command="{type:'show',pendiente:scope.row}">Detalles</el-dropdown-item>
                                  <el-dropdown-item :command="{type:'delete',pendiente:scope.row}">Eliminar</el-dropdown-item>
                                </el-dropdown-menu>
                              </el-dropdown>
                            </template>
                        </el-table-column>
                    </el-table>
                    <br>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <p style="font-size: 15px">
                                <strong>
                                    Solicitud de Fondos Autorizado
                                </strong>
                            </p>
                        </div>
                    </div>
                    <el-table v-loading="loading" :data="data.solicitudes.aprobado" style="width: 100%" max-height="250" highlight-current-row>
                        <el-table-column width="120" align="center" label="Nº Documento">
                            <template slot-scope="scope">
                                <span style="margin-top-left: 10px">@{{ scope.row.id }}</span>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="FECHA_SOLICITUD" label="Fecha Solicitud">
                          <template slot-scope="scope">
                              @{{scope.row.FECHA_SOLICITUD | moment("Y-M-D")}}
                          </template>
                        </el-table-column>
                        <el-table-column align="center" prop="FECHA_AUTORIZACION" label="Fecha Desembolso Autorizado" width="150">
                          <template slot-scope="scope">
                            <div v-if="scope.row.ESTADO==3">
                              @{{scope.row.FECHA_DESEMBOLSO_TESORERIA | moment("Y-M-D")}}
                            </div>
                            <div v-else>
                              @{{scope.row.FECHA_DESEMBOLSO | moment("Y-M-D")}}
                            </div>
                          </template>
                        </el-table-column>
                        <el-table-column align="center" prop="DESCRIPCION" label="Descripcion"></el-table-column>
                        <el-table-column align="center" prop="ESTADO" label="Estado">
                          <template slot-scope="scope">
                              <div slot="reference" class="name-wrapper" v-if="scope.row.ESTADO==1">
                                <el-tag type="success" size="medium">Autorizado</el-tag>
                              </div>
                              <div slot="reference" class="name-wrapper" v-if="scope.row.ESTADO==3">
                                <el-tag type="success" size="medium">Por Desembolsar</el-tag>
                              </div>
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
                              <el-dropdown @command="handleCommandSolicitudAutorizado">
                                <el-button type="primary" size="mini">
                                  Opciones<i class="el-icon-arrow-down el-icon--right"></i>
                                </el-button>
                                <el-dropdown-menu slot="dropdown">
                                  <el-dropdown-item :command="{type:'exportar',pendiente:scope.row}">Exportar</el-dropdown-item>
                                  <el-dropdown-item :command="{type:'show',pendiente:scope.row}">Detalle</el-dropdown-item>
                                  <el-dropdown-item :command="{type:'rendicion',pendiente:scope.row}">Rendicion</el-dropdown-item>
                                </el-dropdown-menu>
                              </el-dropdown>
                            </template>
                        </el-table-column>
                    </el-table>
                    <br>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <p style="font-size: 15px">
                                <strong>
                                    Solicitud de Fondos Rechazado
                                </strong>
                            </p>
                        </div>
                    </div>
                    <el-table v-loading="loading" :data="data.solicitudes.rechazado" style="width: 100%" max-height="250" highlight-current-row>
                        <el-table-column width="120" align="center" label="Nº Documento">
                            <template slot-scope="scope">
                                <span style="margin-top-left: 10px">@{{ scope.row.id }}</span>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="FECHA_SOLICITUD" label="Fecha Solicitud">
                          <template slot-scope="scope">
                              @{{scope.row.FECHA_SOLICITUD | moment("Y-M-D")}}
                          </template>
                        </el-table-column>
                        <el-table-column align="center" prop="FECHA_AUTORIZACION" label="Fecha Desembolso Autorizado" width="150">
                          <template slot-scope="scope">
                            @{{scope.row.FECHA_DESEMBOLSO | moment("Y-M-D")}}
                          </template>
                        </el-table-column>
                        <el-table-column align="center" prop="DESCRIPCION" label="Descripcion"></el-table-column>
                        <el-table-column align="center" prop="ESTADO" label="Estado">
                          <template slot-scope="scope">
                              <div slot="reference" class="name-wrapper" >
                                <el-tag type="danger" size="medium">Rechazada</el-tag>
                              </div>
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
                              <el-dropdown @command="handleCommandSolicitudRechazado">
                                <el-button type="primary" size="mini">
                                  Opciones<i class="el-icon-arrow-down el-icon--right"></i>
                                </el-button>
                                <el-dropdown-menu slot="dropdown">
                                  <el-dropdown-item :command="{type:'sent',pendiente:scope.row}">Reenviar</el-dropdown-item>
                                  <el-dropdown-item :command="{type:'edit',pendiente:scope.row}">Editar</el-dropdown-item>
                                  <el-dropdown-item :command="{type:'show',pendiente:scope.row}">Detalles</el-dropdown-item>
                                  <el-dropdown-item :command="{type:'delete',pendiente:scope.row}">Eliminar</el-dropdown-item>
                                </el-dropdown-menu>
                              </el-dropdown>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
            </template>
            <template v-if="show.create">
              @include('panel.registros.rendicion.solicitud.create')
            </template>
            <template v-if="show.edit">
              @include('panel.registros.rendicion.solicitud.edit')
            </template>
            <template v-if="show.rendicion">
              @include('panel.registros.rendicion.viaticos.index')
            </template>
            <template v-if="show.facturas">
              @include('panel.registros.rendicion.viaticos.qr')
            </template>
            <template v-if="show.descripcion">
              @include('panel.registros.rendicion.viaticos.descripcion')
            </template>
        </div>
        @include('panel.registros.rendicion.solicitud.show')
        @include('panel.registros.rendicion.viaticos.manual')
    </div>
</div>
@section('script')
{!!Html::script('js/solicitud.js')!!}
@endsection
@stop
