<div class="modal fade" id="asignar"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Asignar Limite de Tolerancia</h4>
        </div>
        <div class="modal-body">
            <el-form ref="form" :model="tolerancia" size="mini">
            <el-form-item>
              <label for="">Seleccionar el horario de Tolerancia</label>
              <el-select v-model="asignacion.tolerancia_id" placeholder="Seleccionar" style="width:100%">
                <el-option
                  v-for="item in tolerancias"
                  :key="item.id"
                  :label="item.titulo"
                  :value="item.id">
                </el-option>
              </el-select>
            </el-form-item>
            <el-form-item size="large" class="text-center">
                <el-button round size="small" data-dismiss="modal">Cancelar</el-button>
                <el-button round size="small" type="primary" @click="handleStoreAsignacion()">Crear</el-button>
            </el-form-item>
            </el-form>
        </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
