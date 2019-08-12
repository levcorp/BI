    <div class="modal fade" id="edit"  tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar Cuestionario</h4>
                </div>
                <el-form :model="updateCuestionario" label-width="180px" size="mini" :rules="rules" ref="updateCuestionarioform">
                <div class="modal-body">
                    <input type="text" hidden :value="updateCuestionario.USUARIO_ID={{Auth::user()->id}}">
                    <el-form-item label="Titulo" prop="TITULO">
                        <el-input type="text" v-model="updateCuestionario.TITULO"></el-input>
                    </el-form-item>
                    <el-form-item label="Area" prop="AREA">
                        <el-select style="width:100%" v-model="updateCuestionario.AREA" clearable placeholder="Seleccione una Area">
                            <el-option v-for="item in areas" :key="item.value" :label="item.value" :value="item.value">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="Fecha de Actualización" prop="FECHA_ACTUALIZACION">
                        <el-date-picker style="width:100%"  v-model="updateCuestionario.FECHA_ACTUALIZACION" type="datetime" disabled></el-date-picker>
                    </el-form-item>
                    <el-form-item label="Fecha de Cierre" prop="FECHA_CIERRE">
                        <el-date-picker style="width:100%"  v-model="updateCuestionario.FECHA_CIERRE" type="datetime" :picker-options="pickerOptions"></el-date-picker>
                    </el-form-item>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <el-button size="small" type="primary" @click="handleUpdate()">Actualizar</el-button>
                        <el-button size="small" data-dismiss="modal">Cancelar</el-button>
                    </div>
                </div>
                </el-form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    