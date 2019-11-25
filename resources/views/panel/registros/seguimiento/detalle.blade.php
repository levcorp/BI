<modal name="descripcion" :adaptive="true" height="86%" :scrollable="true"  width="80%">
<div class="row">
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header">
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <p style="color:#a3998d;font-size: 12px;">
                            <strong>
                                COD SAP :
                            </strong>
                            <strong style="color: black">
                            @{{dato.OV_COD_SAP}}
                            </strong>
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <p style="color:#a3998d;font-size: 12px;">
                            <strong>
                                NOM. CLIENTE:
                            </strong>
                            <strong style="color: black">
                            @{{dato.OV_NOM_CLIENTE}}
                            </strong>
                        </p>
                    </div>
                    <div class="col-sm-3">
                        <p style="color:#a3998d;font-size: 12px;">
                            <strong>
                              PROCESADO :
                            </strong>
                            <el-tag
                            :type="dato.PROCESADO=='SI'? 'success':'danger'"
                            effect="light"
                            size="mini">
                            @{{dato.PROCESADO}}
                        </el-tag>
                        </p>
                    </div>
                    <div class="col-sm-3">
                        <p style="color:#a3998d;font-size: 12px;">
                            <strong>
                                TIPO :
                            </strong>
                            <el-tag
                                :type="dato.TIPO=='BTB'? 'primary':dato.TIPO=='NBTB'?'warning':'danger'"
                                effect="light"
                                size="mini">
                                @{{dato.TIPO}}
                            </el-tag>
                        </p>
                    </div>
                    <div class="col-sm-3">
                        <p style="color:#a3998d;font-size: 12px;">
                            <strong>
                                PICKING :
                            </strong>
                            <strong style="color: black">
                            @{{dato.PICKING}}
                            </strong>
                        </p>
                    </div>
                    <div class="col-sm-3">
                        <p style="color:#a3998d;font-size: 12px;">
                            <strong>
                                PEND. FACT. :
                            </strong>
                            <strong style="color: black">
                            @{{dato.PENDIENTE_FACTURACION}}
                            </strong>
                        </p>
                    </div>
                    <div class="col-sm-3">
                        <p style="color:#a3998d;font-size: 12px;">
                            <strong>
                                FECHA ENTREGA :
                            </strong>
                            <strong style="color: black">
                            @{{dato.OV_FEC_ENTREGA | moment("Y-MM-DD")}}
                            </strong>
                        </p>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <el-table  height="400" :header-row-style="headerRowStyleDatos" v-loading="loading.detalle" :data="subdatos" style="width: 100%" border >
                    <el-table-column align="center" label="#"  width="50">
                            <template slot-scope="scope">
                            <p style="font-size: 12px;">
                                @{{scope.$index + 1}}
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column prop="PO_NOM_PROVEEDOR" label="NOM. PROV." width="200"> 
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong>
                                    @{{scope.row.PO_NOM_PROVEEDOR}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column prop="PO_MED_EMBARQUE" label="MED. EMBARQUE" align="center" width="150">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong>
                                    @{{scope.row.PO_MED_EMBARQUE}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" prop="PO_COD_ARTICULO" label="ARTICULO" width="100">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong>
                                    @{{scope.row.PO_COD_ARTICULO}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column prop="PO_COD_VENTA" label="COD. VENTA" width="150">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong>
                                    @{{scope.row.PO_COD_VENTA}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column prop="PO_DESCRIPCION" label="DESCRIPCION" width="150">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong>
                                    @{{scope.row.PO_DESCRIPCION}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column prop="PO_CANTIDAD" label="CANTIDAD" width="100" align="center">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong>
                                    @{{parseFloat(scope.row.PO_CANTIDAD)}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column prop="PO_ALMACEN" label="ALMACEN" align="center" width="100">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong>
                                    @{{scope.row.PO_ALMACEN}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                
                    <el-table-column align="center" prop="PO_FEC_ENTREGA_ARTICULO" label="FEC. ENT. ARTICULO" width="150">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong>
                                    @{{scope.row.PO_FEC_ENTREGA_ARTICULO | moment("Y-MM-DD")}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" prop="PO_T_FABRICACION" label="T. FABRICACION"  width="120" >
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong>
                                    @{{scope.row.PO_T_FABRICACION}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" prop="PO_F_PED_PROV" label="F. PED. PROV"  width="130">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong style="font-size: 11px;" v-if="scope.row.PO_F_PED_PROV">
                                    @{{scope.row.PO_F_PED_PROV | moment("Y-MM-DD")}}
                                </strong>
                                <strong style="color: #F56C6C;font-size: 11px;" v-else>
                                    Sin Fecha
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" prop="PO_F_EST_PED_PROV" label="F. EST. PED. PROV"  width="150">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong style="font-size: 11px;" v-if="scope.row.PO_F_EST_PED_PROV">
                                    @{{scope.row.PO_F_EST_PED_PROV | moment("Y-MM-DD")}}
                                </strong>
                                <strong style="color: #F56C6C;font-size: 11px;" v-else>
                                    Sin Fecha
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" prop="PO_F_EST_ENT_FAB" label="F. EST. ENT. FAB"  width="120">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong style="font-size: 11px;" v-if="scope.row.PO_F_EST_ENT_FAB">
                                    @{{scope.row.PO_F_EST_ENT_FAB | moment("Y-MM-DD")}}
                                </strong>
                                <strong style="color: #F56C6C;font-size: 11px;" v-else>
                                    Sin Fecha
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" prop="PO_F_ENT_FAB" label="PO. F. ENT. FAB"  width="120">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong style="font-size: 11px;" v-if="scope.row.PO_F_ENT_FAB">
                                    @{{scope.row.PO_F_ENT_FAB | moment("Y-MM-DD")}}
                                </strong>
                                <strong style="color: #F56C6C;font-size: 11px;" v-else>
                                    Sin Fecha
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" prop="PO_F_EMB_PROV" label="PO. F. EMB. PROV"  width="130">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong style="font-size: 11px;" v-if="scope.row.PO_F_EMB_PROV">
                                    @{{scope.row.PO_F_EMB_PROV | moment("Y-MM-DD")}}
                                </strong>
                                <strong style="color: #F56C6C;font-size: 11px;" v-else>
                                    Sin Fecha
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" prop="PO_F_EST_EMB_PROV" label="F. EST. EMB. PROV"  width="140">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong style="font-size: 11px;" v-if="scope.row.PO_F_EST_EMB_PROV">
                                    @{{scope.row.PO_F_EST_EMB_PROV | moment("Y-MM-DD")}}
                                </strong>
                                <strong style="color: #F56C6C;font-size: 11px;" v-else>
                                    Sin Fecha
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" prop="PO_F_ARRB_PUERTO" label="F. ARRB. PUERTO"  width="130">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong style="font-size: 11px;" v-if="scope.row.PO_F_ARRB_PUERTO">
                                    @{{scope.row.PO_F_ARRB_PUERTO | moment("Y-MM-DD")}}
                                </strong>
                                <strong style="color: #F56C6C;font-size: 11px;" v-else>
                                    Sin Fecha
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" prop="PO_F_EST_ARRB_PUERTO" label="F. EST. ARRB. PUERTO"  width="160">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong style="font-size: 11px;" v-if="scope.row.PO_F_EST_ARRB_PUERTO">
                                    @{{scope.row.PO_F_EST_ARRB_PUERTO | moment("Y-MM-DD")}}
                                </strong>
                                <strong style="color: #F56C6C;font-size: 11px;" v-else>
                                    Sin Fecha
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" prop="PO_F_ARRB_BO" label="F. ARRB. BO" width="120" >
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong style="font-size: 11px;" v-if="scope.row.PO_F_ARRB_BO">
                                    @{{scope.row.PO_F_ARRB_BO | moment("Y-MM-DD")}}
                                </strong>
                                <strong style="color: #F56C6C;font-size: 11px;" v-else>
                                    Sin Fecha
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" prop="PO_F_EST_ARRB_BO" label="F. EST. ARRB. BO"  width="130">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong style="font-size: 11px;" v-if="scope.row.PO_F_EST_ARRB_BO">
                                    @{{scope.row.PO_F_EST_ARRB_BO | moment("Y-MM-DD")}}
                                </strong>
                                <strong style="color: #F56C6C;font-size: 11px;" v-else>
                                    Sin Fecha
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" prop="PO_F_DESADUANIZACION" label="F. DESADUANIZACION"  width="160">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong style="font-size: 11px;" v-if="scope.row.PO_F_DESADUANIZACION">
                                    @{{scope.row.PO_F_DESADUANIZACION | moment("Y-MM-DD")}}
                                </strong>
                                <strong style="color: #F56C6C;font-size: 11px;" v-else>
                                    Sin Fecha
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" prop="PO_F_EST_DESADUANIZACION" label="F. EST. DESADUANIZACION"  width="190">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong style="font-size: 11px;" v-if="scope.row.PO_F_EST_DESADUANIZACION">
                                    @{{scope.row.PO_F_EST_DESADUANIZACION | moment("Y-MM-DD")}}
                                </strong>
                                <strong style="color: #F56C6C;font-size: 11px;" v-else>
                                    Sin Fecha
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" prop="PO_F_ALMACENES" label="F. ALMACENES"  width="120">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong style="font-size: 11px;" v-if="scope.row.PO_F_ALMACENES">
                                    @{{scope.row.PO_F_ALMACENES | moment("Y-MM-DD")}}
                                </strong>
                                <strong style="color: #F56C6C;font-size: 11px;" v-else>
                                    Sin Fecha
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" prop="PO_F_EST_ALMACENES" label="F. EST. ALMACENES"  width="150">
                        <template slot-scope="scope">
                            <p style="font-size: 11px;">
                                <strong style="font-size: 11px;" v-if="scope.row.PO_F_EST_ALMACENES">
                                    @{{scope.row.PO_F_EST_ALMACENES | moment("Y-MM-DD")}}
                                </strong>
                                <strong style="color: #F56C6C;font-size: 11px;" v-else>
                                    Sin Fecha
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                </el-table>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="text-center">
                        <el-button @click="handleCloseDetalle()" size="mini" type="default">Cerrar</el-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</modal>