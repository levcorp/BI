<el-dialog
  title="¿Autorizar la solicitud?"
  :visible.sync="show.descripcion"
  width="30%"
  center>
  <div class="row text-center">
      <div class="col-sm-12">
          <div>
              <label for="" > Descripicon de factura :</label>
          </div>
      </div>
      <div class="col-sm-12">
        <el-input
        type="textarea"
        :autosize="{ minRows: 2, maxRows: 4}"
        placeholder="Descripción"
        v-model="factura.Descripcion">
        </el-input>
      </div>
  </row>
  <span slot="footer" class="dialog-footer">
    <el-button style="margin-top:15px;" size="mini" @click="show.descripcion = false">Cancel</el-button>
    <el-button style="margin-top:15px;" size="mini" type="primary" @click="handleStoreFactura()">Guardar</el-button>
  </span>
</el-dialog>
