<div class="modal fade" id="show"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Datos del Solicitud de Fondos</h4>
        </div>
        <div class="modal-body">
        <table class="table">
            <tbody>
            <tr>
                <td>Fecha de Solicitud</td>
                <td>
                    @{{data.solicitud.FECHA_SOLICITUD | moment("Y-M-D")}}
                </td>
            </tr>
            <tr>
                <td>Fecha Desembolso</td>
                <td>
                      @{{data.solicitud.FECHA_DESEMBOLSO | moment("Y-M-D")}}
                </td>
            </tr>
            <tr>
                <td>Descripcion</td>
                <td>
                      @{{data.solicitud.DESCRIPCION}}
                </td>
            </tr>
            <tr>
                <td>Importe Solicitado</td>
                <td>
                     @{{data.solicitud.IMPORTE_SOLICITADO  | currency('Bs ', 2)}}
                </td>
            </tr>
            <tr>
                <td>Solicitado por</td>
                <td>
                  <el-popover
                  placement="top"
                  width="350"
                  trigger="click">
                  <el-row>
                      <el-col span="12"><strong>Cargo :</strong></el-col>
                      <el-col span="12">@{{data.solicitado?data.solicitado.cargo:''}}</el-col>
                  </el-row>
                  <el-row>
                      <el-col span="12"><strong>Departamento :</strong></el-col>
                      <el-col span="12">@{{data.solicitado?data.solicitado.departamento:''}}</el-col>
                  </el-row>
                  <el-row>
                      <el-col span="12"><strong>Correo :</strong></el-col>
                      <el-col span="12">@{{data.solicitado?data.solicitado.email:''}}</el-col>
                  </el-row>
                  <el-row>
                      <el-col span="12"><strong>Interno :</strong></el-col>
                      <el-col span="12">@{{data.solicitado?data.solicitado.interno:''}}</el-col>
                  </el-row>
                  <el-row>
                      <el-col span="12"><strong>Cedula Identidad :</strong></el-col>
                      <el-col span="12">@{{data.solicitado?data.solicitado.ci:''}}</el-col>
                  </el-row>
                  <el-row>
                      <el-col span="12"><strong>Celular :</strong></el-col>
                      <el-col span="12">@{{data.solicitado?data.solicitado.celular:''}}</el-col>
                  </el-row>
                  <el-row>
                      <el-col span="12"><strong>Ciudad :</strong></el-col>
                      <el-col span="12">@{{data.solicitado?data.solicitado.ciudad:''}}</el-col>
                  </el-row>
                  <el-button slot="reference" size="mini">@{{data.solicitado.nombre+' '+data.solicitado.apellido}}</el-button>
                  </el-popover>
                </td>
            </tr>
                 <tr>
                <td>Autorizado</td>
                <td>
                  <el-popover
                  placement="top"
                  width="350"
                  trigger="click">
                  <el-row>
                      <el-col span="12"><strong>Cargo :</strong></el-col>
                      <el-col span="12">@{{data.autorizado.cargo}}</el-col>
                  </el-row>
                  <el-row>
                      <el-col span="12"><strong>Departamento :</strong></el-col>
                      <el-col span="12">@{{data.autorizado.departamento}}</el-col>
                  </el-row>
                  <el-row>
                      <el-col span="12"><strong>Correo :</strong></el-col>
                      <el-col span="12">@{{data.autorizado.email}}</el-col>
                  </el-row>
                  <el-row>
                      <el-col span="12"><strong>Interno :</strong></el-col>
                      <el-col span="12">@{{data.autorizado.interno}}</el-col>
                  </el-row>
                  <el-row>
                      <el-col span="12"><strong>Cedula Identidad :</strong></el-col>
                      <el-col span="12">@{{data.autorizado.ci}}</el-col>
                  </el-row>
                  <el-row>
                      <el-col span="12"><strong>Celular :</strong></el-col>
                      <el-col span="12">@{{data.autorizado.celular}}</el-col>
                  </el-row>
                  <el-row>
                      <el-col span="12"><strong>Ciudad :</strong></el-col>
                      <el-col span="12">@{{data.autorizado.ciudad}}</el-col>
                  </el-row>
                  <el-button slot="reference" size="mini">@{{data.autorizado.nombre+' '+data.autorizado.apellido}}</el-button>
                  </el-popover>
                </td>
            </tr>
                 <tr>
                <td>Comentarios</td>
                <td>
                  @{{data.solicitud.COMENTARIOS}}
                </td>
            </tr>
            <tr>
                <td>Motivo</td>
                <td>
                     @{{data.solicitud.MOTIVO}}
                </td>
            </tr>
            <tr>
                <td>Tipo de Solicitud</td>
                <td>
                     @{{data.tiposolicitud.NOMBRE}}
                </td>
            </tr>
            <tr>
                <td>Centro de Costo</td>
                <td>
                     @{{data.centrocostos.NOMBRE}}
                </td>
            </tr>
                 <tr>
                   <td>Medio de Pago</td>
                <td>
                  @{{data.solicitud.MEDIO_PAGO}}
                </td>
            </tr>
                 <tr>
                <td>@{{data.solicitud.MEDIO_PAGO=='Cheque'?'Cheque a Nombre':'Cuenta'}}</td>
                <td>
                   @{{data.solicitud.MEDIO_PAGO=='Cheque'?data.solicitud.CHEQUE_NOMBRE:data.solicitud.CUENTA}}
                </td>
            </tr>
              <tr v-if="data.MEDIO_PAGO=='Abono Cuenta Bancaria'">
                <td>Banco</td>
                <td>
                  @{{((data.banco.Nombre))}}
                </td>
            </tr>
          </tr>
            <tr v-if="data.solicitud.ESTADO==2">
                <td>Motivo de Rechazo</td>
                <td style="color:red;">
                  @{{((data.solicitud.RECHAZO))}}
                </td>
            </tr>
            <tr v-if="data.solicitud.ESTADO==3">
                <td>Motivo de Rechazo</td>
                <td style="color:red;">
                  @{{((data.solicitud.RECHAZO))}}
                </td>
            </tr>
            </tbody>
        </table>
        </div>
        </div>
    </div>
</div>
