<div class="modal fade" id="create"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Crear Limite de Tolerancia</h4>
        </div>
        <div class="modal-body">
            <el-form ref="form" :model="tolerancia" label-width="120px" size="mini">
            <el-form-item label="Titulo">
                <el-input type="text" v-model="tolerancia.titulo"></el-input>
            </el-form-item>
            <el-form-item label="Hora Maxima">
                <el-input type="text" v-model="tolerancia.hora"></el-input>
            </el-form-item>
            <el-form-item size="large">
                <el-button round size="small" data-dismiss="modal">Cancelar</el-button>
                <el-button round size="small" type="primary" @click="handleStoreTolerancia()">Crear</el-button>
            </el-form-item>
            </el-form>
        </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
