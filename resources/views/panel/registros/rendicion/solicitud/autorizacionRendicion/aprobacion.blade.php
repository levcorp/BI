
<el-dialog
  title="Aprobar y genera borrador en SAP"
  :visible.sync="show.aprobar"
  width="30%"
  center>
  <div class="row text-center">
      <div class="col-sm-12">
          <el-select style="width:100%;" filterable clearable v-model="data.aprobacion.cuenta" size="small" placeholder="Cuenta Contable">
              <el-option
              v-for="item in data.cuentas"
              :key="item.AcctCode"
              :label="item.AcctName"
              :value="item.AcctCode">
              </el-option>
          </el-select>
      </div>
      <div class="col-sm-12">
        <br>
        <el-date-picker
          format="dd/MM/yyyy"
          value-format="dd/MM/yyyy"
          style="width:100%;"
          placeholder="Fecha de Documento"
          size="small" v-model="data.aprobacion.fecha">
        </el-date-picker>
      </div>
  </div>
  <span slot="footer" class="dialog-footer">
    <el-button  size="mini" @click="show.aprobar = false">Cancel</el-button>
    <el-button  size="mini" type="success" @click="handlePostAprobarSolicitud()">Autorizar</el-button>
  </span>
</el-dialog>
