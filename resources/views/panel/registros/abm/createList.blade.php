<div class="modal fade" id="create"  tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Crear lista ABM</h4>
                </div>
                <el-form :model="createSolicitud" label-width="180px" size="mini" ref="createMercado">
                <div class="modal-body">
                    <el-form-item label="N° Solicitud" prop="numero">
                        <el-input type="text" v-model="createSolicitud.numero" disabled></el-input>
                    </el-form-item>
                    <el-form-item label="Usuario" prop="nombre">
                        <el-input type="text"  v-model="createSolicitud.nombre='{{Auth::user()->nombre." ".Auth::user()->apellido}}'" disabled></el-input>
                    </el-form-item>
                    <el-form-item label="Fecha Creación" prop="fecha">
                        <el-date-picker v-model="createSolicitud.fecha" type="date" style="width: 100%" disabled></el-date-picker>
                    </el-form-item>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <el-button size="small" type="primary" @click="handleStoreSolicitud()">Crear</el-button>
                        <el-button size="small" data-dismiss="modal">Cancelar</el-button>
                    </div>
                </div>
                </el-form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    