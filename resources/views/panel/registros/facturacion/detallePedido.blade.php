<div class="modal fade" id="detallePedido"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" @click="handleCloseDetallePedido()">
            <span aria-hidden="true">&times;</span></button>
            <p style="font-size: 15px;">
                <strong>
                    DETALLE PEDIDO @{{pedido.Nombre_Cliente}}
                </strong>
            </p>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-6 text-right">
                            <p>
                                <strong>
                                    Vendedor :
                                </strong>
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p>@{{pedido.VENDEDOR}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-6 text-right">
                            <p>
                                <strong>
                                    Nombre Cliente :
                                </strong>
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p>@{{pedido.Nombre_Cliente}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-6 text-right">
                            <p>
                                <strong>
                                    Sucursal :
                                </strong>
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p>@{{pedido.Sucursal}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-6 text-right">
                            <p>
                                <strong>
                                    Total :
                                </strong>
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p>@{{pedido.Total | currency('$', 0)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <el-table border :header-cell-style="handleStyleHeadDetalle" v-loading="loading.detallePedidos" :data="pedidoDetalle" style="width: 100%" height="450" highlight-current-row>
                <el-table-column width="50" align="center" label="#">
                    <template slot-scope="scope">
                        @{{scope.$index +1}}
                    </template>
                </el-table-column>
                <el-table-column align="center" width="100" label="Cod. SAP" prop="N_OV_SAP">
                    <template slot-scope="scope">
                        <p style="font-size: 12px;">
                            <strong>
                                @{{scope.row.N_OV_SAP}}
                            </strong>
                        </p>
                    </template>
                </el-table-column>
                <el-table-column align="center" label="Fabricante" prop="Nombre_Fabricante">
                    <template slot-scope="scope">
                        <p style="font-size: 12px;">
                            <strong>
                                @{{scope.row.Nombre_Fabricante}}
                            </strong>
                        </p>
                    </template>
                </el-table-column>
                <el-table-column align="center" label="Cod. Ventas" prop="cod_ventas">
                    <template slot-scope="scope">
                        <p style="font-size: 12px;">
                            <strong>
                                @{{scope.row.cod_ventas}}
                            </strong>
                        </p>
                    </template>
                </el-table-column>
                <el-table-column align="center" prop="Descricion" label="Descripcion">
                    <template slot-scope="scope">
                        <p style="font-size: 12px;">
                            <strong>
                                @{{scope.row.Descricion}}
                            </strong>
                        </p>
                    </template>
                </el-table-column>
                <el-table-column align="center" prop="Vendedor" label="Fecha Entrega">
                    <template slot-scope="scope">
                        <p style="font-size: 12px;">
                            <strong>
                                @{{scope.row.FECHA_ENTREGA2  | moment("D-M-YYYY")}}
                            </strong>
                        </p>
                    </template>
                </el-table-column>
                <el-table-column align="center" label="Cantidad" prop="Cantidad" width="100">
                    <template slot-scope="scope">
                        <p style="font-size: 12px;">
                            <strong>
                                @{{parseFloat(scope.row.Cantidad)}}
                            </strong>
                        </p>
                    </template>
                </el-table-column>
                <el-table-column align="center" label="Total">
                    <template slot-scope="scope">
                        <p style="font-size: 12px;">
                            <strong>
                                @{{scope.row.total_USD  | currency('$', 0)}}
                            </strong>
                        </p>
                    </template>
                </el-table-column>
            </el-table>  
        </div>
        <div class="modal-footer">
            <div class="text-center">
                <el-button size="mini" type="primary" @click="handleCloseDetallePedido()" round>
                    Cerrar
                </el-button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>