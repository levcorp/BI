<el-dialog
  title="¿Autorizar la solicitud?"
  :visible.sync="show.desembolso"
  width="30%"
  center>
  <div class="row text-center">
      <div class="col-sm-12">
          <div>
              <label for="" > Fecha de desembolso :</label>
          </div>
      </div>
      <div class="col-sm-12">
          <el-date-picker :picker-options="pickerOptions" style="width:100%;" placeholder="Elija una fecha" size="small" v-model="data.desembolso.FECHA_DESEMBOLSO_TESORERIA"></el-date-picker>
      </div>
  </row>
  <span slot="footer" class="dialog-footer">
    <el-button style="margin-top:15px;" size="mini" @click="show.desembolso = false">Cancel</el-button>
    <el-button style="margin-top:15px;" size="mini" type="primary" @click="handlePostDesembolsoSolicitud()">Autorizar</el-button>
  </span>
</el-dialog>
