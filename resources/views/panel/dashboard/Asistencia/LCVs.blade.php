
<el-dialog
  title="BONIFICACION DE LEVCOINS"
  :visible.sync="show.LCV"
  width="40%"
  center>
  <div class="row" >
      <div class="col-sm-12">
          <div class="row">
              <div class="col-sm-3">
                  <div class="pull-right">
                      <label for="" style="margin-top:5px;">Beneficiario</label>
                  </div>
              </div>
              <div class="col-sm-9">
                <v-select :options="data.usuarios" v-model="lcv.beneficiario_id"></v-select>
              </div>
          </div>
          <br>
      </div>
      <div class="col-sm-12">
          <div class="row">
              <div class="col-sm-3">
                  <div class="pull-right">
                      <label for="">Monto</label>
                  </div>
              </div>
              <div class="col-sm-9">
                  <el-radio v-model="lcv.monto" label="100">LCV 100</el-radio>
                  <el-radio v-model="lcv.monto" label="200">LCV 200</el-radio>
              </div>
          </div>
          <br>
      </div>
      <div class="col-sm-12">
          <div class="row">
              <div class="col-sm-3">
                  <div class="pull-right">
                      <label for="">Motivo</label>
                  </div>
              </div>
              <div class="col-sm-9">
                  <el-radio v-model="lcv.motivo" label="Buen Trabajo"></el-radio>
                  <el-radio v-model="lcv.motivo" label="Esfuerzo extra"></el-radio>
              </div>
          </div>
          <br>
      </div>
      <div class="col-sm-12">
          <div class="row">
              <div class="col-sm-12">
                  <div class="text-center">
                      <label for="">Opciones de Motivo</label>
                  </div>
              </div>
              <div class="col-sm-12">
                <v-select :options="data.opcionesMotivo" v-model="lcv.opcion"></v-select>
              </div>
          </div>
      </div>
   </div>
  <span slot="footer" class="dialog-footer">
    <el-button  size="mini" @click="show.LCV = false">Cancelar</el-button>
    <el-button  size="mini" type="success" @click="handleStoreLCV()">Enviar</el-button>
  </span>
</el-dialog>
