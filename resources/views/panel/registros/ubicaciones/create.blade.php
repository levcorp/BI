<div class="modal fade" id="create"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Crear Lista</h4>
            </div>
            <el-form :model="createSucursal" label-width="120px" size="mini" :rules="rules" ref="createSucursal">
            <div class="modal-body">
                <el-form-item label="Fecha Creaci´n" prop="nombre">
                    <el-input type="text" v-model="createSucursal.nombre"></el-input>
                </el-form-item>
                <el-form-item label="Dirección" prop="direccion">
                    <el-input type="text" v-model="createSucursal.direccion"></el-input>
                </el-form-item>
                <el-form-item label="Ciudad" prop="ciudad">
                    <el-input type="email" v-model="createSucursal.ciudad" ></el-input>
                </el-form-item>
                <el-form-item label="Telefono" prop="telefono">
                    <el-input type="text" v-model="createSucursal.telefono"></el-input>
                </el-form-item>
                <el-form-item label="Fax" prop="fax">
                    <el-input type="text" v-model="createSucursal.fax"></el-input>
                </el-form-item>
                <el-form-item label="Correo Electronico" prop="correo">
                    <el-input type="text" v-model="createSucursal.correo"></el-input>
                </el-form-item>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <el-button size="small" type="primary" @click="handleStore('createSucursal')">Crear</el-button>
                    <el-button size="small" data-dismiss="modal">Cancelar</el-button>
                </div>
            </div>
            </el-form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
