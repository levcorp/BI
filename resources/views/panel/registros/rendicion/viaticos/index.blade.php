<div class="box-header">
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
            <p style="font-size: 15px">
                <el-button @click="handleBackIndex2()" type="primary" size="mini" circle icon="el-icon-arrow-left"></el-button>
                <strong>
                    Rendicion de Viáticos Asignados
                </strong>
            </p>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
            <div class="pull-right" style="margin-top-right: 10px">
                <el-button
                size="mini"
                type="primary"
                @click="handleShowFacturaManual()"
                round
                >Agregar Factura Manual
                </el-button>
            </div>
            <div class="pull-left" style="margin-top-right: 10px">
                <el-button
                size="mini"
                type="primary"
                @click="handleRendicionFacturas()"
                round
                >Agregar Factura QR
                </el-button>
            </div>
        </div>
    </div>
</div>
<div class="box-body" style="margin:0px 20px;">
  <div class="row">
    <div class="col-sm-3">
      <div class="row">
        <div class="col-sm-12">
          <strong>
            Responsable Fondo :
          </strong>
        </div>
        <div class="col-sm-12">
          <strong>
            Monto Asignado :
          </strong>
        </div>
        <div class="col-sm-12">
          <strong>
            Monto total Descargo :
          </strong>
        </div>
        <div class="col-sm-12">
          <strong>
            Importe a Rembolsar :
          </strong>
        </div>
        <div class="col-sm-12">
          <strong>
            Tipo de Solicitud :
          </strong>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="row">
        <div class="col-sm-12">
          @{{data.rendicion.solicitado.nombre+' '+data.rendicion.solicitado.apellido}}
        </div>
        <div class="col-sm-12">
          Bs. @{{data.rendicion.IMPORTE_SOLICITADO}}
        </div>
        <div class="col-sm-12">
          Bs. @{{data.rendicion.MONTO_TOTAL==null?'0':data.rendicion.MONTO_TOTAL}}
        </div>
        <div class="col-sm-12">
          Bs. @{{data.rendicion.IMPORTE_REEMBOLSO==null?'0':data.rendicion.IMPORTE_REEMBOLSO}}
        </div>
        <div class="col-sm-12">
           @{{data.rendicion.tiposolicitud.NOMBRE}}
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="row">
        <div class="col-sm-12">
          <strong>Fecha Rendición :</strong>
        </div>
        <div class="col-sm-12">
          <strong>Fecha Asignación :</strong>
        </div>
        <div class="col-sm-12">
          <strong>Medio de Pago :</strong>
        </div>
        <div class="col-sm-12">
          <strong>N° Cuenta :</strong>
        </div>
        <div class="col-sm-12">
          <strong>Centro de Costos :</strong>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="row">
        <div class="col-sm-12">
          {{Carbon\Carbon::now()}}
        </div>
        <div class="col-sm-12">
          @{{data.rendicion.FECHA_DESEMBOLSO_TESORERIA | moment("Y-M-D")}}
        </div>
        <div class="col-sm-12">
          @{{data.rendicion.MEDIO_PAGO}}
        </div>
        <div class="col-sm-12">
          @{{data.rendicion.CUENTA}}
        </div>
        <div class="col-sm-12">
          @{{data.rendicion.centrocostos.NOMBRE}}
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-3">
      <strong>
        Concepto motivo de la solicitud :
      </strong>
    </div>
    <div class="col-sm-9">
      @{{data.rendicion.MOTIVO}}
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-12">
      <h4>Rendicion con Factura</h4>
    </div>
  </div>
  <el-table v-loading="loading" :data="data.viaticos" style="width: 100%" highlight-current-row>
      <el-table-column width="70" align="center" label="#" width="150">
          <template slot-scope="scope">
              <span style="margin-top-left: 10px">@{{ scope.row.id }}</span>
          </template>
      </el-table-column>
      <el-table-column align="center" prop="FECHA_GASTO" label="Fecha Solicitud" width="120">
        <template slot-scope="scope">
            @{{scope.row.FECHA_GASTO}}
        </template>
      </el-table-column>
      <el-table-column align="center" prop="TIPO" label="Tipo">
        <template slot-scope="scope">
          <div slot="reference" class="name-wrapper" v-if="scope.row.TIPO=='Con IVA'">
            <el-tag type="primary" size="medium">Con IVA</el-tag>
          </div>
          <div slot="reference" class="name-wrapper" v-else="scope.row.TIPO=='Sin IVA'">
            <el-tag type="success" size="medium">Sin IVA</el-tag>
          </div>
        </template>
      </el-table-column>
      <el-table-column align="center" prop="DESCRIPCION" label="Descripcion" width="150"></el-table-column>
      <el-table-column align="center" prop="NIT_PROVEEDOR" label="NIT Proveedor" width="150">
        <template slot-scope="scope">
            <span style="margin-top-left: 10px">@{{ scope.row.NIT_PROVEEDOR==null?'-':scope.row.NIT_PROVEEDOR}}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" prop="N_FACTURA" label="Nº Factura" width="150">
        <template slot-scope="scope">
            <span style="margin-top-left: 10px">@{{ scope.row.N_FACTURA==null?'-':scope.row.N_FACTURA}}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" prop="NUMERO_AUTORIZACION" label="Nº Autorizaciòn" width="150">
        <template slot-scope="scope">
            <span style="margin-top-left: 10px">@{{ scope.row.NUMERO_AUTORIZACION==null?'-':scope.row.NUMERO_AUTORIZACION}}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" prop="CODIGO_CONTROL" label="Codigo Control" width="150">
        <template slot-scope="scope">
            <span style="margin-top-left: 10px">@{{ scope.row.CODIGO_CONTROL==null?'-':scope.row.CODIGO_CONTROL}}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" prop="IMPORTE_PAGADO" label="Importe Pagado" width="150">
        <template slot-scope="scope">
            <span style="margin-top-left: 10px">@{{ scope.row.IMPORTE_PAGADO | number('0.00') }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="Centro de Cosotos" width="150">
        <template slot-scope="scope">
            <span style="margin-top-left: 10px">@{{ scope.row.centrocostos.NOMBRE }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" label="Acciones">
          <template slot-scope="scope">
              <el-button circle size="mini" type="danger" icon="el-icon-remove" @click="handleDeleteFactura(scope.$index, scope.row)"></el-button>
          </template>
      </el-table-column>
  </el-table>
</div>
