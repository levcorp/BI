<div class="modal fade" id="create"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Crear Mercado</h4>
            </div>
            <el-form :model="createMercado" label-width="120px" size="mini" :rules="rules" ref="createMercado">
            <div class="modal-body">
                <el-form-item label="Nombre" prop="NOMBRE">
                    <el-input type="text" v-model="createMercado.NOMBRE"></el-input>
                </el-form-item>
                <el-form-item label="Descripcion" prop="DESCRIPCION">
                    <el-input type="text" v-model="createMercado.DESCRIPCION"></el-input>
                </el-form-item>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <el-button size="small" type="primary" @click="handleStore()">Crear</el-button>
                    <el-button size="small" data-dismiss="modal">Cancelar</el-button>
                </div>
            </div>
            </el-form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
