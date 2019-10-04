<el-collapse-transition>
    <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12" v-if="view==2">
        <div class="box box-info">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="pull-left">
                            <p style="font-size: 15px">
                                <el-button @click="handleBack()" type="primary" size="mini" circle icon="el-icon-arrow-left"></el-button>
                                <strong>&nbsp;&nbsp;Detalle de Articulos</strong>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-center">
                            <el-button type="success" @click="handleAdd()" icon="el-icon-message" size="mini">Enviar</el-button>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="pull-right">
                            <el-button type="primary" @click="handleAdd()" icon="el-icon-plus" size="mini">Añadir</el-button>
                        </div>
                    </div>
                </div>
            <el-table :data="ubicaciones" style="width: 100%" height="400" highlight-current-row :default-sort="{prop: 'id', order: 'descending'}">
                <el-table-column align="center" prop="ItemCode" label="Cod. SAP" sortable>
                    <template slot-scope="scope">
                        @{{scope.row.ITEMCODE}}
                    </template>
                </el-table-column>
                <el-table-column align="center" label="Descripcion" sortable>
                    <template slot-scope="scope">
                        @{{scope.row.DESCRIPCION}}
                    </template>
                </el-table-column>
                <el-table-column align="center" label="Cod. Venta" sortable>
                    <template slot-scope="scope">
                        @{{scope.row.COD_VENTA}}
                    </template>
                </el-table-column>
                <el-table-column align="center" label="Ubicación" sortable>
                    <template slot-scope="scope">
                        <el-form :inline="true">
                            <el-input placeholder="Ubicación" size="mini">
                                <template slot="suffix">
                                    <el-button size="mini" style="padding: 4.8px;margin: 2px" circle type="primary" icon="el-icon-check"></el-button>
                                </template>
                            </el-input>
                        </el-form>
                    </template>
                </el-table-column>
                <el-table-column align="center" label="Acciones">
                <template slot-scope="scope">
                    <el-button size="mini" type="danger" icon="el-icon-close" circle @click="handleAdd()"></el-button>
                </template>
                </el-table-column>
            </el-table>
            </div>
        </div>
    </div>
</el-collapse-transition>