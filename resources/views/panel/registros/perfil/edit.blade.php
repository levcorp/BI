<div class="modal fade" id="edit"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modificar Usuario</h4>
        </div>
        <div class="modal-body">
            <el-form ref="form" :model="perfil" label-width="120px" size="mini">
            <el-form-item label="Nombre">
                <el-input type="text" v-model="perfil.nombre"></el-input>
            </el-form-item>
            <el-form-item label="Descripcion">
                <el-input type="textarea" v-model="perfil.descripcion"></el-input>
            </el-form-item>
            <el-form-item size="large">
                <el-button type="primary" @click="update()  ">Actualizar</el-button>
                <el-button @click="closeEdit()">Cancel</el-button>
            </el-form-item>
            </el-form>
        </div>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>