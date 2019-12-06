<transition name="el-fade-in">
    <div v-if="show.oportunidades">
        <div class="col-sm-12">
            <div class="box box-info">
                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <p style="font-size: 15px">
                                <el-button @click="handleBackOportunidades()" type="primary" size="mini" circle icon="el-icon-arrow-left"></el-button>
                                <strong>&nbsp;&nbsp;Oportunidades @{{dato.Sector | sector}} - @{{dato.MESOVA | mes}} - @{{dato.GESTION}}</strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <el-table border :header-cell-style="handleStyleHeadMes" v-loading="loading.oportunidadesMes" :data="oportunidades.mes" style="width: 100%;" highlight-current-row max-heigth="450">
                        <el-table-column align="center" width="50" fixed="left">
                            <template slot-scope="scope">
                                <el-button @click="handleGetOportunidadDetalle(scope.row)" icon="el-icon-plus" circle size="mini" type="primary"></el-button>
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
                                        @{{scope.row.Ejecutivo}}
                                    </strong>
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="Nombre_Cliente" label="Nombre Cliente"  width="270">
                            <template slot-scope="scope">
                                <p style="font-size: 12px;">
                                    <strong>
                                        @{{scope.row.Cliente}}
                                    </strong>
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="Sucursal"  >
                            <template slot-scope="scope">
                                <el-tag :type="scope.row.Sucursal=='La Paz'? 'primary' : scope.row.Sucursal=='Santa Cruz'? 'success' : 'warning'" size="mini">@{{scope.row.Sucursal}}</el-tag>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" :label="dato.OPORTUNIDADESTOTAL_MES ? dato.OPORTUNIDADESTOTAL_MES : 0 | currency('$', 0)">
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
                                <strong>&nbsp;&nbsp;Oportunidades @{{dato.Sector | sector}} - General - @{{dato.GESTION}}</strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <el-table border :header-cell-style="handleStyleHeadGeneral"  v-loading="loading.oportunidadesGeneral" :data="oportunidades.all" style="width: 100%" highlight-current-row min-heigth="550">
                        <el-table-column align="center" width="50" fixed="left">
                            <template slot-scope="scope">
                                <el-button @click="handleGetOportunidadDetalle(scope.row)" icon="el-icon-plus" circle size="mini" type="primary"></el-button>
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
                                        @{{scope.row.Ejecutivo}}
                                    </strong>
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="Nombre_Cliente" label="Nombre Cliente" >
                            <template slot-scope="scope">
                                <p style="font-size: 12px;">
                                    <strong>
                                        @{{scope.row.Cliente}}
                                    </strong>
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="Sucursal" width="100"  >
                            <template slot-scope="scope">
                                <el-tag :type="scope.row.Sucursal=='La Paz'? 'primary' : scope.row.Sucursal=='Santa Cruz'? 'success' : 'warning'" size="mini">@{{scope.row.Sucursal}}</el-tag>
                            </template>
                        </el-table-column>
                        <template v-for="itemM in oportunidades.meses">
                            <el-table-column align="center" :label="itemM.Mes | mes">
                                <el-table-column align="center" :label="itemM.Total | currency('$', 0)" width="130">
                                        <template slot-scope="scope">
                                            <p style="font-size: 12px;" v-if="itemM.Mes==scope.row.Mes">
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
                    </el-table>
                </div>
            </div>
        </div>
    </div>
</transition>

