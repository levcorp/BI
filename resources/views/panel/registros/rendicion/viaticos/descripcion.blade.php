<el-dialog
  title="¿Añadir Factura?"
  :visible.sync="show.descripcion"
  width="30%"
  center>
  <div class="row text-center">
      <div class="col-sm-12">
          <div>
              <label for="" > Centro de Costos:</label>
          </div>
      </div>
      <div class="col-sm-12" label="Tipo de Factura">
        <el-form :inline="true" label-width="150px" :model="factura" class="demo-form-inline">
          <el-form-item >
            <el-select v-if="show.costos" clearable v-model="factura.CENTRO_COSTOS_ID" filterable placeholder="Seleccionar un Centro de Costo" size="small">
                <el-option
                    v-for="item in data.centroCostosRendicion"
                    :key="item.NOMBRE"
                    :label="item.NOMBRE"
                    :value="item.id">
                    <span style="float: left">@{{ item.NOMBRE}}</span>
                </el-option>
            </el-select>
            <el-tag v-if="!show.costos" type="primary">@{{data.centrocostos.NOMBRE}}</el-tag>
          </el-form-item>
          <el-form-item>
            <el-button size="small" type="primary" @click="handleShowCentroCostos" icon="el-icon-edit"></el-button>
          </el-form-item>
        </el-form>
      </div>
      <div class="col-sm-12">
          <div>
              <label for="" > Razon Social:</label>
          </div>
      </div>
      <div style="margin-top:15px" class="col-sm-12">
        <el-input
        type="text"
        placeholder="Razon Social"
        v-model="factura.Razon_Social">
        </el-input>
      </div>
      <div class="col-sm-12">
          <div>
              <label for="" > Descripcion:</label>
          </div>
      </div>
      <div style="margin-top:15px" class="col-sm-12">
        <el-input
        type="textarea"
        :autosize="{ minRows: 2, maxRows: 4}"
        placeholder="Descripción"
        v-model="factura.Descripcion">
        </el-input>
      </div>
  </row>
  <span slot="footer" class="dialog-footer">
    <el-button style="margin-top:15px;" size="mini" @click="show.descripcion = false">Cancelar</el-button>
    <el-button style="margin-top:15px;" size="mini" type="primary" @click="handleStoreFactura()">Guardar</el-button>
  </span>
</el-dialog>
