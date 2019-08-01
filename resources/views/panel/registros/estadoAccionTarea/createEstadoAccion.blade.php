<div class="modal fade" id="createEstadoAccion"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Crear Estado Accion</h4>
            </div>
            <el-form :model="createEstadoAccion" label-width="120px" size="mini" :rules="rulesEstadoAccion" ref="createEstadoAccionForm">
            <div class="modal-body">
                <el-form-item label="Titulo" prop="ACCION">
                    <el-input type="text" v-model="createEstadoAccion.ACCION"></el-input>
                </el-form-item>
                <el-form-item label="Icono" prop="ICON">
                    <el-input type="text" v-model="createEstadoAccion.ICON"></el-input>
                </el-form-item>
                <el-form-item label="Tipo" prop="COLOR">
                    <el-select v-model="createEstadoAccion.COLOR" placeholder="Seleccionar" style="width: 100%" clearable>
                        <el-option label="Primario" value="primary">
                            <span style="float: left">Primary</span>
                            <span style="float: right; color: #409EFF;background-color:#409EFF ;width: 40px;height: 90%; border-radius: 5px;"></span>
                        </el-option>
                        <el-option label="Success" value="success">
                            <span style="float: left">Success</span>
                            <span style="float: right; color: #67c23a;background-color:#67c23a ;width: 40px;height: 90%; border-radius: 5px;"></span>
                        </el-option>
                        <el-option label="Info" value="info">
                            <span style="float: left">Info</span>
                            <span style="float: right; color: #909399;background-color:#909399;width: 40px;height: 90%; border-radius: 5px;"></span>
                        </el-option>
                        <el-option label="Warning" value="warning">
                            <span style="float: left">Warning</span>
                            <span style="float: right; color: #e6a23c;background-color:#e6a23c ;width: 40px;height: 90%; border-radius: 5px;"></span>
                        </el-option>
                        <el-option label="Danger" value="danger">
                            <span style="float: left">Danger</span>
                            <span style="float: right; color: #f56c6c;background-color:#f56c6c ;width: 40px;height: 90%; border-radius: 5px;"></span>
                        </el-option>
                    </el-select>
                </el-form-item>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <el-button size="small" type="primary" @click="handleStoreEstadoAccion()">Crear</el-button>
                    <el-button size="small" data-dismiss="modal">Cancelar</el-button>
                </div>
            </div>
            </el-form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
