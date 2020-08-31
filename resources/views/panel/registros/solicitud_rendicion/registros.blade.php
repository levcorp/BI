<div class="box box-info">
    <div class="box-header">
      <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
              <p style="font-size: 20px;margin-top:5px;">
                  <strong>
                      Mis Solicitudes
                  </strong>
              </p>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
              <div class="pull-right" style="margin-top-right: 10px">
                <vs-button
                  :active="active == 0"
                  @click="active = 0"
                >
                  <i class="bx bx-plus"></i> &nbsp;Crear Solicitud
                </vs-button>
              </div>
          </div>
      </div>
    </div>
    <div class="box-body">
        <vs-table v-model="data.solicitud">
            <template #thead>
              <vs-tr>
                <vs-th style="width:140px;">
                  Nº Documento
                </vs-th >
                <vs-th style="width:140px;">
                  Fecha Solicitud
                </vs-th>
                <vs-th style="width:140px;">
                  Fecha desembolso
                </vs-th>
                <vs-th style="width:220px;">
                  Descripcion
                </vs-th>
                <vs-th>
                  Estado
                </vs-th>
                <vs-th>
                  TipoSolicitud
                </vs-th>
                <vs-th>
                  Opciones
                </vs-th>
              </vs-tr>
            </template>
            <template #tbody>
              <vs-tr
                :key="i"
                v-for="(tr, i) in data.solicitudes"
                :data="tr"
                :is-selected="data.solicitud == tr"
              >
                <vs-td style="width:100px;">
                  @{{ tr.id }}
                </vs-td>
                <vs-td>
                @{{ tr.FECHA_SOLICITUD | moment("Y-M-D")}}
                </vs-td>
                <vs-td>
                  <div v-if="tr.ESTADO==3">
                    @{{tr.FECHA_DESEMBOLSO_TESORERIA | moment("Y-M-D")}}
                  </div>
                  <div v-else>
                      @{{ tr.FECHA_DESEMBOLSO | moment("Y-M-D")}}
                  </div>
                </vs-td>
                <vs-td>
                @{{ tr.DESCRIPCION }}
                </vs-td>
                <vs-td>
                  <div  v-if="tr.ESTADO==1">
                    <span class="label label-primary" style="font-size:1.2rem">Autorizado</span>
                  </div>
                  <div v-if="tr.ESTADO==0">
                    <span class="label label-primary" style="font-size:1.2rem">Pendiente</span>
                  </div>
                  <div v-if="tr.ESTADO==2">
                    <span class="label label-primary" style="font-size:1.2rem">Rechazado</span>
                  </div>
                  <div v-if="tr.ESTADO==3">
                    <span class="label label-primary" style="font-size:1.2rem">A desembolsar</span>
                  </div>
                  <div v-if="tr.ESTADO==3">
                    <span class="label label-primary" style="font-size:1.2rem">En rendicion</span>
                  </div>
                  <div v-if="tr.ESTADO==5">
                    <span class="label label-primary" style="font-size:1.2rem">Finalizada</span>
                  </div>
                </vs-td>
                <vs-td>
                  <div  v-if="tr.URGENTE==1">
                    <span class="label label-danger" style="font-size:1.2rem">Urgente</span>
                  </div>
                  <div v-else="tr.URGENTE==0">
                    <span class="label label-default" style="font-size:1.2rem">Default</span>
                  </div>
                </vs-td>
                <vs-td>
                  <vs-button
                     @click="handleShowDetalle"
                     size="small"
                   >
                      &nbsp;Detalle
                   </vs-button>
                </vs-td>
              </vs-tr>
            </template>
        </vs-table>
    </div>
</div>
