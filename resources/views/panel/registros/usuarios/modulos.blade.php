<div class="modal fade" id="modulo"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modulos del sistema</h4>
        </div>
        <div class="modal-body">
            <el-input v-model="searchModulos" placeholder="Buscar"></el-input>
            <el-table :data="modulos.filter(data => !searchModulos || data.titulo.toLowerCase().includes(searchModulos.toLowerCase()))" style="width: 100%">
            <el-table-column prop="id" width="50" label="#"></el-table-column>
            <el-table-column prop="titulo" label="Titulo"></el-table-column>
            <el-table-column prop="descripcion" label="Descripción"></el-table-column>
            <el-table-column align="center" label="Añadir">
                <template slot-scope="scope">
                    <el-button
                    size="small"
                    circle
                    type="primary"
                    icon="el-icon-plus"
                    @click="handlePer(scope.$index, scope.row)">
                    </el-button>
              </template>
            </el-table-column>
        </el-table>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>