<div class="modal fade" id="grupo"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Asignar Grupo</h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <el-table :data="grupos" style="width: 100%" v-loading="loading.cuestionario">
                        <el-table-column prop="NOMBRE" label="Nombre">
                        </el-table-column>
                        <el-table-column prop="DESCRIPCION" label="Descripcion">
                        </el-table-column>
                        <el-table-column align="center" label="Operaciones">
                            <template slot="header" slot-scope="scope">
                                <el-input
                                v-model="searchGrupos"
                                size="mini"
                                placeholder="Buscar Grupo"/>
                            </template>
                            <template slot-scope="scope">
                                <el-button plain circle icon="el-icon-plus" size="mini" type="success" @click="handleAssignmentGrupo(scope.$index, scope.row)"></el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <el-button size="small" data-dismiss="modal">Cancelar</el-button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
