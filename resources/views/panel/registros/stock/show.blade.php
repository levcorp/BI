<div class="modal fade" id="show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg"  role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">@{{item.ItemName}}</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-6">
                    <p style="font-size: 15px;">
                        <strong>Codigo de Venta : </strong>@{{item.U_Cod_Vent}}
                    </p>
                </div>    
                <div class="col-sm-6">
                    <p style="font-size: 15px;">
                        <strong>Fabricante : </strong>@{{item.FirmName}}
                    </p>
                </div>    
            </div>
            <br>
            <el-table :data="stock" style="width: 100%" height="330" highlight-current-row v-loading="loadingStock">
                <el-table-column align="center" prop="EMPRESA" label="Empresa"></el-table-column>
                <el-table-column align="center" prop="ALMACEN" label="Almacen"></el-table-column>
                <el-table-column align="center" prop="OnHand" label="En Stock">
                    <template slot-scope="scope">
                        <el-tag
                        :type="scope.row.OnHand === '0.00' ? 'info' : 'success'"
                        disable-transitions>@{{scope.row.OnHand}}
                        </el-tag>
                    </template>
                </el-table-column>
                <el-table-column align="center" prop="IsCommited" label="Comprometido" width="115">
                    <template slot-scope="scope">
                        <el-tag
                        :type="scope.row.IsCommited === '0.00' ? 'info' : 'success'"
                        disable-transitions>@{{scope.row.IsCommited}}
                        </el-tag>
                    </template>
                </el-table-column>
                <el-table-column align="center" label="Pedido" >
                    <template slot-scope="scope">
                        <el-tag
                        :type="scope.row.OnOrder === '0.00' ? 'info' : 'success'"
                        disable-transitions>@{{scope.row.OnOrder}}
                        </el-tag>
                    </template>
                </el-table-column>
                <el-table-column align="center" label="Trasladándose"  width="115">
                    <template slot-scope="scope">
                        <el-tag
                        :type="scope.row.TRASLADOS_OUT === '0.00' ? 'info' : 'success'"
                        disable-transitions>@{{scope.row.TRASLADOS_OUT}}
                        </el-tag>
                    </template>
                </el-table-column>
                <el-table-column align="center" label="En Transito"  width="95">
                      <template slot-scope="scope">
                        <el-tag
                        :type="scope.row.TRASLADOS_IN === '0.00' ? 'info' : 'success'"
                        disable-transitions>@{{scope.row.TRASLADOS_IN}}
                        </el-tag>
                    </template>
                </el-table-column>
                <el-table-column align="center" label="Cantidad OV" >
                    <template slot-scope="scope">
                        <el-tag
                        :type="scope.row.OV === '0.00' ? 'info' : 'success'"
                        disable-transitions>@{{scope.row.OV}}
                        </el-tag>
                    </template>
                </el-table-column>
                <el-table-column align="center" label="Cantidad Compra">
                    <template slot-scope="scope">
                        <el-tag
                        :type="scope.row.PO === '0.00' ? 'info' : 'success'"
                        disable-transitions>@{{scope.row.OV}}
                        </el-tag>
                    </template>
                </el-table-column>
                <el-table-column align="center" label="Disponible"  width="100">
                   <template slot-scope="scope">
                        <el-tag
                        :type="scope.row.DISPONIBLE === '0.00' ? 'info' : 'success'"
                        disable-transitions>@{{scope.row.DISPONIBLE}}
                        </el-tag>
                    </template>
                </el-table-column>
                <el-table-column align="center" prop="Clasificacion" label="Clasificación"  width="115"></el-table-column>
            </el-table>
        </div>
        <div class="modal-footer">
            <div class="text-center">
                <el-button size="medium" type="primary" icon="el-icon-close" data-dismiss="modal"> Cerrar</el-button>
            </div>
        </div>
    </div>
    </div>
</div>