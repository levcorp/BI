<div class="modal fade" id="accion"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Crear Accion</h4>
            </div>
            <el-form :model="createAccion" label-width="120px" size="mini" :rules="rulesAccion" ref="formAccion">
            <div class="modal-body">
                <el-form-item label="Fecha Registro">
                    <el-date-picker style="width:100%"  v-model="createAccion.FECHA_CREACION" type="datetime"  disabled></el-date-picker>
                </el-form-item>
                <el-form-item label="Estado" prop="ESTADO_ACCION_ID">
                    <el-select clearable v-model="createAccion.ESTADO_ACCION_ID" filterable placeholder="Seleccionar Estado" size="mini"  style="width:100%">
                        <el-option
                            v-for="item in estadoAcciones"
                            :key="item.ACCION"
                            :label="item.ACCION"
                            :value="item.id">
                            <span style="float: left">@{{ item.ACCION }}</span>
                            <span style="float: right; color: #8492a6; font-size: 13px"><i class="el-icon-tickets"></i></span>
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Descripcion" prop="DESCRIPCION">
                    <el-input v-model="createAccion.DESCRIPCION" type="textarea" placeholder="Descripcion de Tarea" :autosize="{ minRows: 3, maxRows: 3}"></el-input>
                </el-form-item>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <el-button size="small" data-dismiss="modal">Cancelar</el-button>
                    <el-button size="small" type="primary" @click="handleStoreAccion()">Crear Tarea</el-button>
                </div>
            </div>
            </el-form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
