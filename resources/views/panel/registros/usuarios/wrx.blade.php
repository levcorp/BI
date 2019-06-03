<div class="modal fade" id="permisos"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Permisos del Modulo @{{title}}</h4>
        </div>
        <el-form ref="form" :model="Form" label-width="120px" size="mini">
       <div class="modal-body">
       <el-form-item label="Crear">
            <el-radio-group v-model="Form.create" size="medium">
            <el-radio border label="Si"></el-radio>
            <el-radio border label="No"></el-radio>
            </el-radio-group>
        </el-form-item>
        <el-form-item label="Eliminar">
            <el-radio-group v-model="Form.delete" size="medium" fill="#FC362C"> 
            <el-radio border label="Si"></el-radio>
            <el-radio border label="No"></el-radio>
            </el-radio-group>
        </el-form-item>
        <el-form-item label="Edicion">
            <el-radio-group v-model="Form.update" size="medium">
            <el-radio border label="Si"></el-radio>
            <el-radio border label="No"></el-radio>
            </el-radio-group>
        </el-form-item>
        </div>  
        <div class="modal-footer">
            <el-button type="info" data-dismiss="modal">Close</el-button>
            <el-button type="primary" @click="postPermisos">Añadir</el-button>
        </div>
        </el-form>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>