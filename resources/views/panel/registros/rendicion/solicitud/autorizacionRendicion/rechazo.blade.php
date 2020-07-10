
<el-dialog
  title="¿Esta seguro de rechazar la solicitud?"
  :visible.sync="show.rechazo"
  width="30%"
  center>
  <div class="row text-center">
      <div class="col-sm-12">
          <div>
              <label for="" > Motivo de Rechazo :</label>
          </div>
      </div>
      <div class="col-sm-12">
          <el-input
            style="width:100%;"
            type="textarea"
            :rows="2"
            placeholder="Motivo de Rechazo"
            v-model="data.rechazo.RECHAZO">
          </el-input>
      </div>
  </div>
  <span slot="footer" class="dialog-footer">
    <el-button style="margin-top:15px;" size="mini" @click="show.rechazo = false">Cancel</el-button>
    <el-button style="margin-top:15px;" size="mini" type="danger" @click="handlePostRechazoSolicitud()">Rechazar</el-button>
  </span>
</el-dialog>
