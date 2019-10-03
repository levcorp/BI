<el-collapse-transition>
    <div v-if="show.list">
        <div>
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                                <p style="font-size: 17px">
                                    <strong>
                                        Listas ABM Pendientes
                                    </strong>
                                </p>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                                <div class="pull-right" style="margin-right: 10px">
                                    <el-button
                                    size="mini"
                                    type="primary"
                                    icon="el-icon-plus"
                                    @click="handleCreateSolicitud()"
                                    >Nueva Lista
                                    </el-button>
                                </div>
                            </div>
                        </div>
                        <el-table :data="listABMPendiente" style="width: 100%"  highlight-current-row>
                            <el-table-column width="80" align="center" prop="numero" label="#"></el-table-column>
                            <el-table-column align="center" label="Usuario">
                                <template slot-scope="scope">
                                    <p style="margin-left: 10px">@{{ scope.row.usuario.nombre+" "+scope.row.usuario.apellido}}</p>
                                </template>
                            </el-table-column>
                            <el-table-column align="center" prop="fecha" label="Fecha"></el-table-column>
                            <el-table-column align="center" prop="estado" label="Estado">
                                <template slot-scope="scope">
                                    <el-tag size="mini" type="danger">@{{ scope.row.estado}}</el-tag>
                                </template>
                            </el-table-column>
                            <el-table-column align="center" label="Operaciones" width="180">
                                <template slot="header" slot-scope="scope">
                                    <el-input
                                    size="mini"
                                    placeholder="Buscar Lista"/>
                                </template>
                                <template slot-scope="scope">
                                    <el-button circle icon="el-icon-message" size="mini" type="success" @click="handleMessage(scope.$index, scope.row)"></el-button>
                                    <el-button circle icon="el-icon-plus" size="mini" type="primary" @click="handleShow(scope.$index, scope.row)"></el-button>
                                    <el-button circle size="mini" type="danger" icon="el-icon-delete" @click="handleDelete(scope.$index, scope.row)"></el-button>
                                </template>
                            </el-table-column>
                        </el-table>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                                <p style="font-size: 17px">
                                    <strong>
                                        Listas ABM Realizadas
                                    </strong>
                                </p>
                            </div>
                        </div>
                        <el-table :data="listABMRealizado" style="width: 100%" height="400" highlight-current-row>
                            <el-table-column align="center" prop="numero" label="#"></el-table-column>
                            <el-table-column align="center" label="Usuario">
                                <template slot-scope="scope">
                                    <p style="margin-left: 10px">@{{ scope.row.usuario.nombre+" "+scope.row.usuario.apellido}}</p>
                                </template>
                            </el-table-column>
                            <el-table-column align="center" prop="fecha" label="Fecha"></el-table-column>
                            <el-table-column align="center" prop="estado" label="Estado">
                                <template slot-scope="scope">
                                    <el-tag size="mini" type="success">@{{ scope.row.estado}}</el-tag>
                                </template>
                            </el-table-column>
                            <el-table-column align="center" label="Operaciones" width="180">
                                <template slot="header" slot-scope="scope">
                                    <el-input
                                    size="mini"
                                    placeholder="Buscar Lista"/>
                                </template>
                                <template slot-scope="scope">
                                    <el-button circle icon="el-icon-plus" size="mini" type="primary" @click="handleShow(scope.$index, scope.row)"></el-button>
                                </template>
                            </el-table-column>
                        </el-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</el-collapse-transition>