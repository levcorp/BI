<div class="modal fade" id="edit"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Crear Tarea</h4>
            </div>
            <el-form :model="updateTarea" label-width="120px" size="mini" :rules="rules" ref="formTareaUpdate">
            <div class="modal-body">
                <el-form-item label="Titulo" prop="TAREA">
                    <el-input v-model="updateTarea.TAREA" type="text" clearable placeholder="Titulo de Tarea"></el-input>
                    <input v-model="updateTarea.CUSUARIO_ID='{{Auth::user()->id}}'" type="text" hidden/>
                </el-form-item>
                <el-form-item label="Especialidad" prop="BRAND">
                    <el-select style="width:100%" v-model="updateTarea.BRAND" clearable placeholder="Seleccione una especialidad">
                        <el-option v-for="item in brand" :key="item.value" :label="item.value" :value="item.value">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Sector" prop="SECTOR">
                    <el-select style="width:100%" v-model="updateTarea.SECTOR" clearable placeholder="Seleccione una sector" disabled>
                        <el-option v-for="item in sector" :key="item.value" :label="item.value" :value="item.value">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Fecha Registro">
                    <el-date-picker style="width:100%"  v-model="updateTarea.FECHA_REGISTRO" type="datetime"  disabled></el-date-picker>
                </el-form-item>
                <el-form-item label="Fecha Cierre" prop="FECHA_CIERRE">
                    <el-date-picker style="width:100%"  v-model="updateTarea.FECHA_CIERRE" type="date"  placeholder="Seleccione una fecha"></el-date-picker>
                </el-form-item>
                <el-form-item label="Cliente" prop="CLIENTE" >
                    <el-select style="width:100%" v-model="updateTarea.CLIENTE" disabled
                        filterable
                        remote
                        clearable
                        reserve-keyword
                        placeholder="Selecciona un cliente"
                        :remote-method="handleSearchCliente"
                        :loading="loading" >
                        <el-option v-for="item in clientes" :key="item.Nombre" :label="item.Nombre" :value="item.Nombre">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Descripcion" prop="DESCRIPCION">
                    <el-input v-model="updateTarea.DESCRIPCION" type="textarea" placeholder="Descripcion de Tarea" :autosize="{ minRows: 3, maxRows: 3}"></el-input>
                </el-form-item>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <el-button size="small" data-dismiss="modal">Cancelar</el-button>
                    <el-button size="small" type="primary" @click="handleUpdate()">Actualizar Tarea</el-button>
                </div>
            </div>
            </el-form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
