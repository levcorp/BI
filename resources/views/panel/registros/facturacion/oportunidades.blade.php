<transition name="el-fade-in">
    <div v-if="show.oportunidades">
        <div class="col-sm-12">
            <div class="box box-info" v-loading="loading" style="min-height: 400px;">
                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <p style="font-size: 15px">
                                <el-button @click="handleBackOportunidades()" type="primary" size="mini" circle icon="el-icon-arrow-left"></el-button>
                                <strong>&nbsp;&nbsp;Oportunidades</strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <el-table :data="oportunidades.mes" style="width: 100%" highlight-current-row>
                        <el-table-column align="center" :label="dato.Sector | sector">
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
                            <el-table-column align="center" label="Mes">
                                <template slot-scope="scope">
                                    <p style="font-size: 12px;">
                                        <strong>
                                            @{{scope.row.Mes | mes}}
                                        </strong>
                                    </p>
                                </template>
                            </el-table-column>
                            <el-table-column align="center" label="Año" >
                                <template slot-scope="scope">
                                    <p style="font-size: 12px;">
                                        @{{scope.row.Año}}
                                    </p>
                                </template>
                            </el-table-column>
                            <el-table-column align="center" label="Total"  >
                                <template slot-scope="scope">
                                    <p style="font-size: 12px;">
                                        <strong>
                                            @{{scope.row.Total | currency('$', 2)}}
                                        </strong>
                                    </p>
                                </template>
                            </el-table-column>
                        </el-table-column>
                    </el-table>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="box box-info" v-loading="loading" style="min-height: 400px;">
                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <p style="font-size: 15px">
                                <el-button @click="handleBackOportunidades()" type="primary" size="mini" circle icon="el-icon-arrow-left"></el-button>
                                <strong>&nbsp;&nbsp;Oportunidades</strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <el-table :data="oportunidades.all" style="width: 100%" highlight-current-row>
                        <el-table-column align="center" :label="dato.Sector | sector">
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
                            <template v-for="itemY in oportunidades.años">
                                <el-table-column align="center" :label="itemY.Año">
                                    <template v-for="itemM in oportunidades.meses">
                                        <el-table-column align="center" :label="itemM.Mes | mes" v-if="itemY.Año==itemM.Año">
                                            <el-table-column align="center" :label="itemM.Total | currency('$', 2)" width="130">
                                                    <template slot-scope="scope">
                                                        <p style="font-size: 12px;" v-if="itemM.Mes==scope.row.Mes && itemY.Año==scope.row.Año">
                                                            <strong>
                                                                @{{scope.row.Total | currency('$', 2)}}
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
                        </el-table-column>
                    </el-table>
                </div>
            </div>
        </div>
    </div>
</transition>

