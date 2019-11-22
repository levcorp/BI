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
      <div class="col-sm-12">
          <div class="box box-info" style="">
              <div class="box-header">
                  <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                          <p style="font-size: 15px">
                              <strong>&nbsp;&nbsp;  Seguimiento de Ordenes de Venta</strong>
                          </p>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <div class="pull-right" style="margin-right: 10px">
                              <el-button :loading="loading.export" size="mini" @click="handleExportSeguimiento()" type="primary" icon="el-icon-notebook-2" round> Exportar Lista</el-button>
                            </div>
                        </div>
                    </div>
              </div>
              <div class="box-body">
                  <el-table v-loading="loading.datos" :header-row-style="headerRowStyleDatos" @expand-change="handleChange" :data="datos" style="width: 100%" height="430" highlight-current-row>
                      <el-table-column type="expand">
                        <template slot-scope="props">
                            <div v-for="(item, index) in subdatos">
                                <div v-if="props.row.OV_COD_SAP==item.key">
                                    <div class="table-responsive">
                                        <el-table v-loading="loading.detalle" :data="item.value" style="width: 100%" border :header-row-style="headerRowStyleDetalle">
                                            <el-table-column align="center" label="#"  width="50">
                                                    <template slot-scope="scope">
                                                    <p style="font-size: 12px;">
                                                        @{{scope.$index + 1}}
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_NOM_PROVEEDOR" label="NOM. PROV." width="100"> 
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_NOM_PROVEEDOR}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_MED_EMBARQUE" label="MED. EMBARQUE" align="center" width="70">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_MED_EMBARQUE}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_COD_ARTICULO" label="ARTICULO" width="80">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_COD_ARTICULO}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_COD_VENTA" label="COD. VENTA" width="100">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_COD_VENTA}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_DESCRIPCION" label="DESCRIPCION" width="100">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_DESCRIPCION}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_CANTIDAD" label="CANTIDAD" width="80" align="center">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{parseFloat(scope.row.PO_CANTIDAD)}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_ALMACEN" label="ALMACEN" align="center" width="80">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_ALMACEN}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                        
                                            <el-table-column prop="PO_FEC_ENTREGA_ARTICULO" label="FEC. ENTREGA ARTICULO" width="80" >
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_FEC_ENTREGA_ARTICULO | moment("Y-MM-DD")}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_T_FABRICACION" label="T. FABRICACION"  width="80" >
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_T_FABRICACION?scope.row.PO_T_FABRICACION:'Sin Fecha' | moment("Y-MM-DD")}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_F_PED_PROV" label="F. PED. PROV"  width="80">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_F_PED_PROV ? scope.row.PO_F_PED_PROV:'Sin Fecha' | moment("Y-MM-DD")}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_F_EST_PED_PROV" label="F. EST. PED. PROV"  width="80">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_F_EST_PED_PROV ? scope.row.PO_F_EST_PED_PROV :'Sin Fecha' | moment("Y-MM-DD")}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_F_EST_ENT_FAB" label="F. EST. ENT. FAB"  width="80">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_F_EST_ENT_FAB ? scope.row.PO_F_EST_ENT_FAB:'Sin Fecha' | moment("Y-MM-DD")}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_F_ENT_FAB" label="PO. F. ENT. FAB"  width="80">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_F_ENT_FAB ? scope.row.PO_F_ENT_FAB :'Sin Fecha' | moment("Y-MM-DD")}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_F_EMB_PROV" label="PO. F. EMB. PROV"  width="80">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_F_EMB_PROV ? scope.row.PO_F_EMB_PROV :'Sin Fecha' | moment("Y-MM-DD")}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_F_EST_EMB_PROV" label="F. EST. EMB. PROV"  width="80">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_F_EST_EMB_PROV ?scope.row.PO_F_EST_EMB_PROV  :'Sin Fecha' | moment("Y-MM-DD")}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_F_ARRB_PUERTO" label="F. ARRB. PUERTO"  width="80">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_F_ARRB_PUERTO ? scope.row.PO_F_ARRB_PUERTO  :'Sin Fecha' | moment("Y-MM-DD")}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_F_EST_ARRB_PUERTO" label="F. EST. ARRB. PUERTO"  width="80">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_F_EST_ARRB_PUERTO ?scope.row.PO_F_EST_ARRB_PUERTO  :'Sin Fecha' | moment("Y-MM-DD")}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_F_ARRB_BO" label="F. ARRB. BO" width="80" >
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_F_ARRB_BO ?scope.row.PO_F_ARRB_BO  :'Sin Fecha' | moment("Y-MM-DD")}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_F_EST_ARRB_BO" label="F. EST. ARRB. BO"  width="80">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_F_EST_ARRB_BO ? scope.row.PO_F_EST_ARRB_BO :'Sin Fecha' | moment("Y-MM-DD")}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_F_DESADUANIZACION" label="F. DESADUANIZACION"  width="80">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_F_DESADUANIZACION ? scope.row.PO_F_DESADUANIZACION:'Sin Fecha' | moment("Y-MM-DD")}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_F_EST_DESADUANIZACION" label="F. EST. DESADUANIZACION"  width="80">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_F_EST_DESADUANIZACION ? scope.row.PO_F_EST_DESADUANIZACION :'Sin Fecha' | moment("Y-MM-DD")}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_F_ALMACENES" label="F. ALMACENES"  width="80">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_F_ALMACENES ? scope.row.PO_F_ALMACENES  :'Sin Fecha' | moment("Y-MM-DD")}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                            <el-table-column prop="PO_F_EST_ALMACENES" label="F. EST. ALMACENES"  width="80">
                                                <template slot-scope="scope">
                                                    <p style="font-size: 11px;">
                                                        <strong>
                                                            @{{scope.row.PO_F_EST_ALMACENES ?scope.row.PO_F_EST_ALMACENES :'Sin Fecha' | moment("Y-MM-DD")}}
                                                        </strong>
                                                    </p>
                                                </template>
                                            </el-table-column>
                                        </el-table>
                                    </div>
                                </div>
                            </div>
                        </template>
                      </el-table-column>
                      <el-table-column align="center" label="#" sortable width="70">
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
                      <el-table-column align="center" label="NOM. CLIENTE" sortable width="170">
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
                      <el-table-column align="center" label="COMENTARIOS" sortable width="220">
                          <template slot-scope="scope">
                              <p style="font-size: 12px;">
                                    @{{scope.row.OV_COMENTARIOS ? scope.row.OV_COMENTARIOS:'SIN COMENTARIO'}}
                              </p>
                          </template>
                      </el-table-column>
                  </el-table>
              </div>
          </div>
      </div>
  </div>
@section('script')
{!!Html::script('js/seguimiento.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop