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
                <el-input type="text" v-model="updateUser.givenname"></el-input>
            </el-form-item>
            <el-form-item label="Apellido">
                <el-input type="text" v-model="updateUser.sn"></el-input>
            </el-form-item>
            <el-form-item label="Email">
                <el-input type="email" v-model="updateUser.mail" :disabled="true"></el-input>
            </el-form-item>
            <el-form-item label="Ciudad">
                <el-input type="text" v-model="updateUser.l"></el-input>
            </el-form-item>
            <el-form-item label="Pais">
                <el-input type="text" v-model="updateUser.c"></el-input>
            </el-form-item>
              <el-form-item label="Celular">
                <el-input type="text" v-model="updateUser.mobile"></el-input>
            </el-form-item>
            <el-form-item label="Telefono">
                <el-input type="number" v-model="updateUser.ipphone"></el-input>
            </el-form-item>
            <el-form-item label="Puesto">
                <el-input type="text" v-model="updateUser.title"></el-input>
            </el-form-item>
            <el-form-item label="Departamento">
                <el-input type="text" v-model="updateUser.department"></el-input>
            </el-form-item>
            <el-form-item label="Sucursal">
                <el-select v-model="updateUser.sucursal_id" clearable placeholder="Seleccionar Sucursal" style="width: 100%;">
                    <el-option v-for="item in sucursales" :key="item.id" :label="item.nombre" :value="item.id">
                    </el-option>
                </el-select>
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