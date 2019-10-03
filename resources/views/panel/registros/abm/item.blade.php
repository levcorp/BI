<el-collapse-transition>
    <div v-if="show.item">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                            <p style="font-size: 17px">
                                <el-button size="mini" type="primary" icon="el-icon-arrow-left"
                                @click="handleBack()"></el-button>
                                <strong>
                                    &nbsp;Detalle de ABM
                                </strong>
                            </p>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                            <div class="text-center" v-if="solicitud_estado=='Pendiente'">
                                <el-button size="mini" type="success" icon="el-icon-message"
                                @click="handleSendMail()">Enviar</el-button>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
                            <div class="pull-right" style="margin-right: 10px" v-if="solicitud_estado=='Pendiente'">
                                <el-button size="mini" type="primary" icon="el-icon-menu"
                                @click="handleCreateItem()">Crear Articulo</el-button>
                            </div>
                        </div>
                    </div>
                    <el-table :data="items" style="width: 100%"  highlight-current-row>
                        <el-table-column align="center" prop="cod_venta" label="Cod. Venta" width="110">
                            <template slot-scope="scope">
                                <p style="font-size: 12px">
                                    <strong>@{{ scope.row.cod_venta}}</strong>
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="cod_item" label="Cod. Item" width="110">
                            <template slot-scope="scope">
                                <p style="font-size: 12px">
                                    <strong>@{{ scope.row.cod_item}}</strong>
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="cod_compra" label="Cod. Compra" width="110">
                            <template slot-scope="scope">
                                <p style="font-size: 12px">@{{ scope.row.cod_compra}}</p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="cod_especialidad" label="Especialidad" width="110">
                            <template slot-scope="scope">
                                <p style="font-size: 12px">
                                    <strong>@{{ scope.row.cod_especialidad}}</strong>
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="fabricante" label="Fabricante" width="120">
                            <template slot-scope="scope">
                                <p style="font-size: 12px">
                                    @{{ scope.row.fabricante}}
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="medida" label="Medida" width="90">
                            <template slot-scope="scope">
                                <p style="font-size: 12px">
                                    @{{ scope.row.medida}}
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="proveedor" label="Proveedor" width="200">
                            <template slot-scope="scope">
                                <p style="font-size: 12px">
                                    @{{ scope.row.proveedor}}
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="comentarios" label="Comentarios" width="200">
                            <template slot-scope="scope">
                                <p style="font-size: 12px">
                                    @{{ scope.row.comentarios}}
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="descripcion" label="Descripcion" width="200">
                            <template slot-scope="scope">
                                <p style="font-size: 12px">
                                    @{{ scope.row.descripcion}}
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="upc" label="UPC" width="120">
                            <template slot-scope="scope">
                                <div v-if="scope.row.upc==null">
                                    <p style="font-size: 12px">
                                        <strong>Sin UPC</strong>
                                    </p>
                                </div>
                                <div v-else>
                                    <p style="font-size: 12px">@{{ scope.row.upc}}</p>
                                </div>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="Acciones" fixed="right" width="100" v-if="solicitud_estado=='Pendiente'">
                            <template slot-scope="scope">
                                <el-button circle size="mini" type="danger" icon="el-icon-delete" @click="handleDeleteItem(scope.$index, scope.row)"></el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
            </div>
        </div>
    </div>
</el-collapse-transition>