<div class="modal fade" id="facturaManual"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Factura Manual</h4>
        </div>
        <div class="modal-body">
            <el-form ref="form" :model="facturaManual" label-width="150px" size="mini">
            <el-form-item label="NIT Emisor">
                <el-input type="text" v-model="facturaManual.NIT_Emisor"></el-input>
            </el-form-item>
            <el-form-item label="Numero Factura">
                <el-input type="text" v-model="facturaManual.Numero_Factura"></el-input>
            </el-form-item>
            <el-form-item label="Numero de Autorizacion">
                <el-input type="email" v-model="facturaManual.Numero_Autorizacion" :disabled="true"></el-input>
            </el-form-item>
            <el-form-item label="Fecha de Emision">
                <el-input type="text" v-model="facturaManual.Fecha_Emision"></el-input>
            </el-form-item>
            <el-form-item label="Total">
                <el-input type="text" v-model="facturaManual.Total"></el-input>
            </el-form-item>
              <el-form-item label="Importe Base Credito Fiscal">
                <el-input type="text" v-model="facturaManual.Importe_Credito_Fiscal"></el-input>
            </el-form-item>
            <el-form-item label="Codigo de Control">
                <el-input type="number" v-model="facturaManual.Codigo_Control"></el-input>
            </el-form-item>
            <el-form-item label="NIT Comprador">
                <el-input type="text" v-model="facturaManual.NIT_Comprador"></el-input>
            </el-form-item>
            <el-form-item label="Importe Ventas ">
                <el-input type="text" v-model="facturaManual.Importe_Ventas"></el-input>
            </el-form-item>
            <el-form-item label="Importe ICE/IEHD/TASAS">
                <el-input type="text" v-model="facturaManual.Importe_ICE"></el-input>
            </el-form-item>
            <el-form-item label="Importe no Sujeto Credito Fiscal ">
                <el-input type="text" v-model="facturaManual.Importe_No_Sujeto"></el-input>
            </el-form-item>
            <el-form-item label="Descuentos ">
                <el-input type="text" v-model="facturaManual.Descuentos"></el-input>
            </el-form-item>
            <el-form-item label="Descripcion ">
                <el-input type="text" v-model="facturaManual.Descripcion"></el-input>
            </el-form-item>
            <el-form-item size="large">
                <el-button type="primary" @click="">Crear</el-button>
                <el-button @click="cerrarShow()">Cancel</el-button>
            </el-form-item>
            </el-form>
        </div>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
