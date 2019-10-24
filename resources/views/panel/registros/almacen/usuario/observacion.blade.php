<div class="modal fade" id="validarArticulo"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <div style="padding: 15px;border-bottom: 1px solid #e5e5e5;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <div class="text-center">
                  <p style="margin:0px;font-size: 15px;color:#409EFF">
                      <strong>&nbsp;&nbsp;¿Verificar Articulo?</strong>
                  </p>
                </div>
            </div>
            <el-form :model="createArticulo" size="mini" ref="createListForm">
            <div class="modal-body">
              <p style="font-size: 15px;color:#606266;">
                  ¿ Si existe algun tipo de observación llene el siguiente campo ?
              </p>
              <el-form-item>
                    <el-input @keydown.native.enter.prevent="handleStoreArticulosCheck()" type="textarea" v-model="createArticulo.OBSERVACION" placeholder="Observaciones"></el-input>
                </el-form-item>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <el-button round size="small" data-dismiss="modal">Cancelar</el-button>
                    <el-button round size="small" type="primary" @click="handleStoreArticulosCheck()">Validar</el-button>
                </div>
            </div>
            </el-form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
