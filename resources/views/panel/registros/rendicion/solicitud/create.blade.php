<div class="modal fade" id="createRendicion"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Crear Rendición</h4>
            </div>
            <el-form :model="createRendicion" label-width="120px" size="mini" :rules="rules" ref="createRendicion">
            <div class="modal-body">
                <el-form-item label="Responsable del fondo" prop="NOMBRE">
                    <el-input type="text" v-model="createRendicion.RESPONSABLE_ID"></el-input>
                </el-form-item>
                <el-form-item label="Carnet de Identidad" prop="CI">
                    <el-input type="number" v-model="createRendicion.CI"></el-input>
                </el-form-item>
                <el-form-item label="Concepto" prop="DESCRIPCION">
                    <el-input type="text" v-model="createRendicion.CONCEPTO"></el-input>
                </el-form-item>
                <el-form-item label="Fecha de asignación" prop="DESCRIPCION">
                    <el-date-picker
                        v-model="createRendicion.FECHA_ASIGNACION"
                        type="datetime"
                        placeholder="Select date and time" style="width: 100%">
                    </el-date-picker>
                </el-form-item>
                <el-form-item label="Monto Asignado" prop="DESCRIPCION">
                    <el-input-number size="mini" :min="1" v-model="createRendicion.MONTO_ASIGNADO" controls-position="right" style="width: 100%"></el-input-number>
                </el-form-item>
                <el-form-item label="BANCO" prop="DESCRIPCION">
                    <el-input-number size="mini" :min="1" v-model="createRendicion.MONTO_ASIGNADO" controls-position="right" style="width: 100%"></el-input-number>
                </el-form-item>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <el-button round size="small" data-dismiss="modal">Cancelar</el-button>
                    <el-button round size="small" type="primary" @click="handleStoreRendicion()">Crear</el-button>
                </div>
            </div>
            </el-form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
