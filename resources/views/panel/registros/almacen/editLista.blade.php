<div class="modal fade" id="editList"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Crear Lista</h4>
            </div>
            <el-form :model="editList" :rules="rulesLista" label-width="120px" size="mini" ref="editListForm">
            <div class="modal-body">
                <el-form-item label="Titulo" prop="NOMBRE">
                    <el-input type="text" v-model="editList.NOMBRE"></el-input>
                </el-form-item>
                <el-form-item label="Descripcion" prop="DESCRIPCION">
                    <el-input type="text" v-model="editList.DESCRIPCION"></el-input>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                </el-form-item>
                    <el-button round size="small" type="primary" @click="handleUpdateList()">Actualizar</el-button>
                    <el-button round size="small" data-dismiss="modal">Cancelar</el-button>
                </div>
            </div>
            </el-form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
