<div class="modal fade" id="facturaManual"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Factura Manual</h4>
        </div>
        <div class="modal-body">
            <el-form ref="form" :model="data.facturaManual" label-width="150px" size="mini">
            <el-form-item label="Tipo de Factura">
              <el-select v-model="data.facturaManual.tipo" clearable placeholder="Select" style="width:100%">
                <el-option
                   v-for="item in data.opciones_manual"
                   :key="item.value"
                   :label="item.label"
                   :value="item.value">
                </el-option>
              </el-select>
            </el-form-item>
            <div v-if="show.conIVA">
              <el-form-item label="Razon Social">
                  <el-input type="text" v-model="data.facturaManual.Razon_Social"></el-input>
              </el-form-item>
              <el-form-item label="NIT Emisor">
                  <el-input type="text" v-model="data.facturaManual.NIT_Emisor"></el-input>
              </el-form-item>
              <el-form-item label="Fecha de Factura">
                  <el-date-picker style="width:100%" value-format="dd-MM-yyyy" format="dd/MM/yyyy" v-model="data.facturaManual.Fecha_Emision" type="date"></el-date-picker>
              </el-form-item>
              <el-form-item label="Numero de Autorizacion">
                  <el-input type="email" v-model="data.facturaManual.Numero_Autorizacion"></el-input>
              </el-form-item>
              <el-form-item label="Codigo de Control">
                  <el-input type="email" v-model="data.facturaManual.Codigo_Control"></el-input>
              </el-form-item>
              <el-form-item label="Total">
                  <el-input type="text" v-model="data.facturaManual.Total"></el-input>
              </el-form-item>
              <el-form-item label="Descripcion ">
                  <el-input type="text" v-model="data.facturaManual.Descripcion"></el-input>
              </el-form-item>
            </div>
            <div v-if="show.sinIVA">
              <el-form-item label="Razon Social">
                  <el-input type="text" v-model="data.facturaManual.Razon_Social"></el-input>
              </el-form-item>
              <el-form-item label="Fecha de Gasto">
                  <el-date-picker style="width:100%" value-format="dd/MM/yyyy" format="dd/MM/yyyy" v-model="data.facturaManual.Fecha_Emision" type="date"></el-date-picker>
              </el-form-item>
              <el-form-item label="Total">
                  <el-input type="text" v-model="data.facturaManual.Total"></el-input>
              </el-form-item>
              <el-form-item label="Descripcion ">
                  <el-input type="text" v-model="data.facturaManual.Descripcion"></el-input>
              </el-form-item>
            </div>
            <el-form :inline="true" label-width="150px" :model="data.facturaManual" class="demo-form-inline">
              <el-form-item label="Centro de Costos">
                <el-select v-if="show.costos" clearable v-model="data.facturaManual.CENTRO_COSTOS_ID" filterable placeholder="Seleccionar un Centro de Costo" size="small">
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
            <div class="text-center">
                <el-button size="small" data-dismiss="modal">Cancel</el-button>
                <el-button size="small" type="primary" @click="handleStoreFacturaManual">Crear</el-button>
            </div>
            </el-form>
        </div>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
