<div class="modal fade" id="detalleOportunidad"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <p style="font-size: 15px;">
                <strong>
                    DETALLE PEDIDO @{{pedido.Nombre_Cliente}}
                </strong>
            </p>
        </div>
        <div class="modal-body">
            <el-table border :data="oportunidades.detalle" style="width: 100%" height="450" highlight-current-row>
                <el-table-column width="70" align="center" label="#">
                    <template slot-scope="scope">
                        @{{scope.$index +1}}
                    </template>
                </el-table-column>
                <el-table-column align="center" prop="Vendedor" label="Vendedor">
                    <template slot-scope="scope">
                        <p style="font-size: 12px;">
                            <strong>
                                @{{scope.row.Ejecutivo}}
                            </strong>
                        </p>
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
                                @{{scope.row.Cantidad}}
                            </strong>
                        </p>
                    </template>
                </el-table-column>
                <el-table-column align="center" label="TOTAL" prop="total_USD">
                    <template slot-scope="scope">
                        <p style="font-size: 12px;">
                            <strong>
                                @{{scope.row.TotalUSD}}
                            </strong>
                        </p>
                    </template>
                </el-table-column>
            </el-table>  
        </div>
        <div class="modal-footer">
            <div class="text-center">
                <el-button size="mini" type="primary" data-dismiss="modal" round>
                    Cerrar
                </el-button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>