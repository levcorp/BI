<div class="modal fade" id="create"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Añadir Articulo</h4>
            </div>
            <el-form :model="createList" label-width="120px" size="mini" ref="createLista">
                <div class="modal-body">
                    <el-form-item label="Fecha Creación" prop="nombre">
                        <el-date-picker disabled="false" style="width: 100%" type="datetime" v-model="createList.FECHA_CREACION"></el-date-picker>
                    </el-form-item>
                    <el-form-item label="Usuario" prop="direccion">
                        <el-input disabled type="text" value="{{Auth::user()->nombre.' '.Auth::user()->apellido}}"></el-input>
                    </el-form-item>
                    <input type="text" hidden :value="createList.USUARIO_ID='{{Auth::user()->id}}'">
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
