<div class="modal fade" id="detalleOportunidad"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" @click="handleCloseDetalleOportunidad()">
            <span aria-hidden="true">&times;</span></button>
            <p style="font-size: 15px;">
                <strong>
                    DETALLE OPORTUNIDAD @{{oportunidad.Nombre_Cliente}}
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
                            <p>@{{oportunidad.Ejecutivo}}</p>
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
                            <p>@{{oportunidad.Cliente}}</p>
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
                            <p>@{{oportunidad.Sucursal}}</p>
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
                            <p>@{{oportunidad.Total | currency('$', 0)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <el-table :header-cell-style="handleStyleHeadDetalle" v-loading="loading.detalleOportunidades" border :data="oportunidades.detalle" style="width: 100%" height="450" highlight-current-row>
                <el-table-column width="50" align="center" label="#">
                    <template slot-scope="scope">
                        @{{scope.$index +1}}
                    </template>
                </el-table-column>
                <el-table-column align="center" prop="Descricion" label="Descripcion">
                    <template slot-scope="scope">
                        <p style="font-size: 12px;">
                            <strong>
                                @{{scope.row.DescripcionItem}}
                            </strong>
                        </p>
                    </template>
                </el-table-column>
                <el-table-column align="center" label="Cod. Ventas" prop="cod_ventas">
                    <template slot-scope="scope">
                        <p style="font-size: 12px;">
                            <strong>
                                @{{scope.row.CodigoVenta}}
                            </strong>
                        </p>
                    </template>
                </el-table-column>
                <el-table-column align="center" label="Fabricante" prop="Nombre_Fabricante">
                    <template slot-scope="scope">
                        <p style="font-size: 12px;">
                            <strong>
                                @{{scope.row.Marca}}
                            </strong>
                        </p>
                    </template>
                </el-table-column>
                <el-table-column align="center" label="Cantidad" prop="Cantidad">
                    <template slot-scope="scope">
                        <p style="font-size: 12px;">
                            <strong>
                                @{{parseFloat(scope.row.Cantidad)}}
                            </strong>
                        </p>
                    </template>
                </el-table-column>
                <el-table-column align="center" label="Total" prop="total_USD">
                    <template slot-scope="scope">
                        <p style="font-size: 12px;">
                            <strong>
                                @{{scope.row.TotalUSD | currency('$', 0)}}
                            </strong>
                        </p>
                    </template>
                </el-table-column>
            </el-table>  
        </div>
        <div class="modal-footer">
            <div class="text-center">
                <el-button size="mini" type="primary" @click="handleCloseDetalleOportunidad()" round>
                    Cerrar
                </el-button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>