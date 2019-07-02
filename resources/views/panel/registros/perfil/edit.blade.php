    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Editar Perfil</h4>
          </div>
          <el-form ref="formUpdate" :rules="rules" :model="Uperfil" size="mini">
          <div class="modal-body">
                <el-form-item label="Nombre de Perfil" prop="nombre">
                    <el-input v-model="Uperfil.nombre"></el-input>
                </el-form-item>
                <el-form-item label="Descripcion" prop="descripcion">
                    <el-input type="textarea" v-model="Uperfil.descripcion"></el-input>
                </el-form-item>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <el-button size="mini" type="default" icon="el-icon-close" data-dismiss="modal"> Cerrar</el-button>
                    <el-button size="mini" type="primary" icon="el-icon-check" @click="handleUpdate()"> Guardar</el-button>
                </div>
            </div>
            </el-form>
        </div>
      </div>
    </div>