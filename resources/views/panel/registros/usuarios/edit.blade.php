<div class="modal fade" id="edit"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modificar Usuario</h4>
        </div>
        <div class="modal-body">
            <el-form ref="form" :model="updateUser" label-width="120px" size="mini">
            <el-form-item label="Nombre">
                <el-input type="text" v-model="updateUser.nombre"></el-input>
            </el-form-item>
            <el-form-item label="Apellido">
                <el-input type="text" v-model="updateUser.apellido"></el-input>
            </el-form-item>
            <el-form-item label="Email">
                <el-input type="email" v-model="updateUser.email" :disabled="true"></el-input>
            </el-form-item>
            <el-form-item label="Ciudad">
                <el-input type="text" v-model="updateUser.ciudad"></el-input>
            </el-form-item>
            <el-form-item label="Pais">
                <el-input type="text" v-model="updateUser.pais"></el-input>
            </el-form-item>
              <el-form-item label="Celular">
                <el-input type="text" v-model="updateUser.celular"></el-input>
            </el-form-item>
            <el-form-item label="Telefono">
                <el-input type="number" v-model="updateUser.telefono"></el-input>
            </el-form-item>
            <el-form-item label="Puesto">
                <el-input type="text" v-model="updateUser.puesto"></el-input>
            </el-form-item>
            <el-form-item label="Organizacion">
                <el-input type="text" v-model="updateUser.organizacion "></el-input>
            </el-form-item>
            <el-form-item size="large">
                <el-button type="primary" @click="putUser()">Actualizar</el-button>
                <el-button @click="cerrarShow()">Cancel</el-button>
            </el-form-item>
            </el-form>
        </div>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>