<div class="modal fade" id="list"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lista de Tolerancias</h4>
            </div>
            <div class="modal-body">
              <el-table :data="tolerancias" style="width: 100%" height="450" >
                  <el-table-column align="center" prop="titulo" label="Titulo" ></el-table-column>
                  <el-table-column align="center" prop="hora" label="Hora Maxima" ></el-table-column>
              
                  <!---<el-table-column align="center" prop="memberof[0]" label="Miembro" width="180"></el-table-column>-->
                  <el-table-column align="center" label="Acciones">
                    <template slot-scope="scope">
                      <el-button
                        size="mini"
                        type="danger"
                        circle
                        icon="el-icon-remove"
                        @click="handleRemoveTolerancia(scope.$index, scope.row)">
                      </el-button>
                    </template>
                  </el-table-column>
              </el-table>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <el-button round size="small" data-dismiss="modal">Cerrar</el-button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
