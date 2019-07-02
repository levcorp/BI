  <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Añadir Modulos</h4>
          </div>
          <div class="modal-body">
            <el-table :data="addmodulos.filter(data => !MAsearch || data.nombre.toLowerCase().includes(MAsearch.toLowerCase()))" style="width: 100%" v-loading="loadingAdd" height="450">
                <el-table-column prop="id" label="#" width="50"></el-table-column>
                <el-table-column prop="nombre" label="Titulo"></el-table-column>
                <el-table-column prop="descripcion" label="Descripcion">
                </el-table-column>
                <el-table-column label="Operaciones" align="center">
                    <template slot="header" slot-scope="scope">
                        <el-input
                        v-model="MAsearch"
                        size="mini"
                        placeholder="Buscar Modulo"/>
                    </template>
                    <template slot-scope="scope">
                        <el-button
                        size="mini"
                        type="warning"
                        icon="el-icon-plus"
                        @click="handleAdd(scope.$index, scope.row)"
                        circle>
                        </el-button>
                    </template>
                </el-table-column>
            </el-table> 
          </div>
          <div class="modal-footer">
            <el-button size="medium" type="primary" icon="el-icon-close" data-dismiss="modal"> Cerrar</el-button>
          </div>
        </div>
      </div>
    </div>