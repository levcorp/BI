<transition name="el-fade-in">
    <div v-if="show.pedidos">
        <div class="col-sm-12">
            <div class="box box-info" >
                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <p style="font-size: 15px">
                                <el-button @click="handleBackPedidos()" type="primary" size="mini" circle icon="el-icon-arrow-left"></el-button>
                                <strong>&nbsp;&nbsp;Pedidos @{{dato.Sector | sector}} - @{{dato.MESOVA | mes}} - @{{dato.GESTION}}</strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <el-table border :header-cell-style="handleStyleHeadMes" v-loading="loading.pedidosMes" :data="pedidos" style="width: 100%" highlight-current-row  max-height="450">
                        <el-table-column align="center" width="50" fixed="left">
                            <template slot-scope="scope">
                                <el-button @click="handleGetPedidoDetalle(scope.row)" icon="el-icon-plus" circle size="mini" type="primary"></el-button>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="#"  width="70">
                            <template slot-scope="scope">
                                <p style="font-size: 12px;">
                                    @{{scope.$index + 1}}
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="Vendedor">
                            <template slot-scope="scope">
                                <p style="font-size: 12px;">
                                    <strong>
                                        @{{scope.row.VENDEDOR}}
                                    </strong>
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="Nombre_Cliente" label="Nombre Cliente"  width="270">
                            <template slot-scope="scope">
                                <p style="font-size: 12px;">
                                    <strong>
                                        @{{scope.row.Nombre_Cliente}}
                                    </strong>
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="Sucursal">
                            <template slot-scope="scope">
                                <el-tag :type="scope.row.Sucursal=='LP'? 'primary' : scope.row.Sucursal=='SC'? 'success' : 'warning'" size="mini">@{{scope.row.Sucursal | sucursal}}</el-tag>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" :label="dato.TOTAL_OVA ? dato.TOTAL_OVA : 0 | currency('$', 0)">
                            <template slot-scope="scope">
                                <p style="font-size: 12px;">
                                    <strong>
                                        @{{scope.row.Total | currency('$', 0)}}
                                    </strong>
                                </p>
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
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <p style="font-size: 15px">
                                <strong>&nbsp;&nbsp;Pedidos @{{dato.Sector | sector}} - General</strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box-body" >
                    <el-table border :header-cell-style="handleStyleHeadGeneral"  v-loading="loading.pedidosGeneral" max-height="550" :data="pedidosAll" style="width: 100%" highlight-current-row>
                        <el-table-column align="center" width="50" fixed="left">
                            <template slot-scope="scope">
                                <el-button @click="handleGetPedidoDetalle(scope.row)" icon="el-icon-plus" circle size="mini" type="primary"></el-button>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="#"  width="70">
                            <template slot-scope="scope">
                                <p style="font-size: 12px;">
                                    @{{scope.$index + 1}}
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="Nombre_Cliente" label="Nombre Cliente">
                            <template slot-scope="scope">
                                <p style="font-size: 12px;">
                                    <strong>
                                        @{{scope.row.Nombre_Cliente}}
                                    </strong>
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="Sucursal" width="100" >
                            <template slot-scope="scope">
                                <el-tag :type="scope.row.Sucursal=='LP'? 'primary' : scope.row.Sucursal=='SC'? 'success' : 'warning'" size="mini">@{{scope.row.Sucursal | sucursal}}</el-tag>
                            </template>
                        </el-table-column>
                        <template v-for="itemY in year">
                            <el-table-column align="center" :label="itemY.Year">
                                <template v-for="itemM in mes">
                                    <el-table-column align="center" :label="itemM.Moth | mes" v-if="itemY.Year==itemM.Year">
                                        <el-table-column align="center" :label="itemM.Total | currency('$', 0)" width="130">
                                            <template slot-scope="scope">
                                                <p style="font-size: 12px;" v-if="itemM.Moth==scope.row.Moth && itemY.Year==scope.row.Year">
                                                    <strong>
                                                        @{{scope.row.Total | currency('$', 0)}}
                                                    </strong>
                                                </p>
                                                <p style="font-size: 12px;" v-else>
                                                    <strong>
                                                        -
                                                    </strong>
                                                </p>
                                            </template>
                                        </el-table-column>
                                    </el-table-column>
                                </template>
                            </el-table-column>
                        </template>
                    </el-table>
                </div>
            </div>
        </div>
    </div>
</transition>