<div class="modal fade" id="new"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nuevo Codigo</h4>
            </div>
            <el-form :inline="true" size="mini" ref="createMercado">
            <div class="modal-body">
                <div class="text-center">
                    <el-form-item label="Codigo">
                        <el-input v-model="ssl.codigo" style="width: 100%"></el-input>
                    </el-form-item>
                </div>
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
