<div class="modal fade" id="editAsignacion"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Asignación</h4>
            </div>
            <el-form :model="createList" :rules="rulesLista" label-width="120px" size="mini" ref="createListForm">
            <div class="modal-body">
              <div class="text-center">
                <el-transfer
                  style="text-align: left; display: inline-block;"
                  filterable
                  filter-placeholder="Buscar Fabricante"
                  v-model="editAsignacion.FABRICANTES"
                  :props="{key: 'FirmCode',label: 'FirmName'}"
                  :titles="['Fabricantes', 'Asignar']"
                  :data="editFabricantes">
                </el-transfer>
              </div>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                </el-form-item>
                  <el-button size="small" data-dismiss="modal" round>Cancelar</el-button>
                  <el-button size="small" type="danger" @click="handleDeleteAsignacion()" round>Eliminar</el-button>
                  <el-button size="small" type="primary" @click="handleUpdateAsignacion()" round>Actualizar</el-button>
                </div>
            </div>
            </el-form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
