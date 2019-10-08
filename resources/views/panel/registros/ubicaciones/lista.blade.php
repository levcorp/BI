<transition name="fade" mode="out-in" :duration="{ enter: 250, leave: 250 }">
    <template v-if="view==1">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <h3 class="box-title">Listas Pendientes</h3>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <div class="pull-right" style="margin-right: 10px">
                                <el-button @click="handleCreate()" size="mini" type="primary" icon="el-icon-plus">Crear Lista</el-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <el-table :data="listsPendiente" style="width: 100%" highlight-current-row :default-sort="{prop: 'id', order: 'descending'}">
                        <el-table-column align="center" prop="id" width="150" label="#" sortable>
                            <template slot-scope="scope">
                                @{{scope.$index+1}}
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="FECHA_CREACION" label="Fecha Creacion" sortable>
                            <template slot-scope="scope">
                                @{{scope.row.FECHA_CREACION | moment('calendar',null,{sameElse : 'YYYY-MM-DD HH:mm'})  | capitalize({ onlyFirstLetter: true })}}
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="Usuario" sortable>
                            <template slot-scope="scope">
                                @{{scope.row.usuario.nombre+' '+scope.row.usuario.apellido}}
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="Acciones">
                            <template slot-scope="scope">
                                <el-button size="mini" type="success" icon="el-icon-message" circle @click="handleExportForList(scope.$index, scope.row)"></el-button>
                                <el-button size="mini" type="primary" icon="el-icon-plus" circle @click="handleAddView(scope.$index, scope.row)"></el-button>
                                <el-button size="mini" type="danger" icon="el-icon-delete" circle @click="handleDeleteList(scope.$index, scope.row)"></el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
            </div>
        </div>
    </template>
</transition>
<transition name="fade" mode="out-in" :duration="{ enter: 250, leave: 250 }">
    <template v-if="view==1">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <h3 class="box-title">Listas Realizadas</h3>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <el-table :data="listsRealizado" style="width: 100%" highlight-current-row :default-sort="{prop: 'id', order: 'descending'}">
                        <el-table-column align="center" prop="id" width="150" label="#" sortable>
                            <template slot-scope="scope">
                                @{{scope.$index+1}}
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="FECHA_CREACION" label="Fecha Creacion" sortable>
                            <template slot-scope="scope">
                                @{{scope.row.FECHA_CREACION | moment('calendar',null,{sameElse : 'YYYY-MM-DD HH:mm'})  | capitalize({ onlyFirstLetter: true })}}
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="Usuario" sortable>
                            <template slot-scope="scope">
                                @{{scope.row.usuario.nombre+' '+scope.row.usuario.apellido}}
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="Acciones">
                            <template slot-scope="scope">
                                <el-button size="mini" type="primary" icon="el-icon-plus" circle @click="handleAddView(scope.$index, scope.row)"></el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
            </div>
        </div>
    </template>
</transition>

