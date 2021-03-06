<div class="box-header"  v-loading="load.create">
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
            <p style="font-size: 15px">
                <el-button @click="handleBackIndex()" type="primary" size="mini" circle icon="el-icon-arrow-left"></el-button>
                <strong>
                    Solicitud de fondos a cuenta de rendición
                </strong>
            </p>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
            <div class="pull-right" style="margin-top-right: 10px">
                <el-button
                size="mini"
                type="success"
                icon="el-icon-check"
                @click="handleValidateRendicionSolicitud()"
                round
                >Guardar
                </el-button>
            </div>
        </div>
    </div>
</div>
<el-alert type="error" v-if="errorsSolicitud.length>0">
  <ul>
    <li v-for="error in errorsSolicitud">@{{error}}</li>
  </ul>
</el-alert>
<div class="box-body" style="margin:0px 20px;" v-loading="load.create">
    <div class="row" style="margin-top:15px;">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-2">
                    <div class="pull-right">
                        <label for="" style="margin-top:5px;"> Fecha de Solicitud :</label>
                    </div>
                </div>
                <div class="col-sm-10">
                    <el-date-picker :picker-options="pickerOptions" disabled style="width:100%;" placeholder="Elija una fecha" size="small" v-model="solicitud.FECHA_SOLICITUD"></el-date-picker>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:15px;">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-6">
                    <div class="pull-right">
                        <label for="" style="margin-top:5px;"> Presupuesto :</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <el-checkbox v-model="solicitud.PRESUPUESTO" size="small" label="Presupuesto" border></el-checkbox>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-6">
                    <div class="pull-right">
                        <label for="" style="margin-top:5px;"> Desembolso Urgente :</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <el-checkbox v-model="solicitud.URGENTE" size="small" label="Urgente" border></el-checkbox>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-6">
                    <div class="pull-right">
                        <label for="" > Fecha de desembolso requerida :</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <el-date-picker :picker-options="pickerOptions" :disabled="!solicitud.URGENTE" style="width:100%;" placeholder="Elija una fecha" size="small" v-model="solicitud.FECHA_DESEMBOLSO"></el-date-picker>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:15px;">
        <div class="col-sm-2">
            <div class="pull-right">
                <label for="" style="margin-top:5px;"> Descripcion :</label>
            </div>
        </div>
        <div class="col-sm-10">
            <el-input type="text" placeholder="Llenar campo" size="small" v-model="solicitud.DESCRIPCION"></el-input>
        </div>
    </div>
    <div class="row" style="margin-top:15px;">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-4">
                    <div class="pull-right">
                        <label for="" style="margin-top:5px;"> Importe Solicitado :</label>
                    </div>
                </div>
                <div class="col-sm-8">
                    <el-input type="number" size="small" placeholder="Llenar campo" v-model="solicitud.IMPORTE_SOLICITADO"></el-input>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <label style="margin-top:5px;color:#409EFF;">@{{values.literal | uppercase}} @{{values.decimal}}/100 BOLIVIANOS</label>
        </div>
    </div>
    <div class="row" style="margin-top:15px;">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-4">
                    <div class="pull-right">
                        <label for="" style="margin-top:5px;">Solicitado por :</label>
                    </div>
                </div>
                <div class="col-sm-8">
                    <el-input disabled type="text" size="small" :value="data.usuario.nombre+' '+data.usuario.apellido"></el-input>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-4">
                    <div class="pull-right">
                        <label for=""  style="margin-top:5px;">Cedula de Identidad :</label>
                    </div>
                </div>
                <div class="col-sm-8">
                    <el-input disabled type="text" size="small" :value="data.usuario.ci"></el-input>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:15px;">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-4">
                    <div class="pull-right">
                        <label for="" style="margin-top:5px;">Autorizado por</label>
                    </div>
                </div>
                <div class="col-sm-8">
                    <el-select style="width:100%;" clearable v-model="solicitud.AUTORIZADO_ID" filterable placeholder="Seleccionar Usuario" size="small">
                        <el-option
                            v-for="item in data.usuarios"
                            :key="item.nombre+' '+item.apellido"
                            :label="item.nombre+' '+item.apellido"
                            :value="item.id">
                            <span style="float: left">@{{ item.nombre+' '+item.apellido }}</span>
                            <span style="float: right; color: #8492a6; font-size: 13px"><i class="el-icon-user"></i></span>
                        </el-option>
                    </el-select>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
             <div class="row">
                <div class="col-sm-4">
                    <div class="pull-right">
                        <label for="">Comentarios de Autorización :</label>
                    </div>
                </div>
                <div class="col-sm-8">
                    <el-input type="text"  placeholder="Llenar campo" size="small" v-model="solicitud.COMENTARIOS"></el-input>
                </div>
            </div>
        </div>
    </div>
    <div class="row"  style="margin-top:15px;">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-3">
                    <div class="pull-right">
                        <label for="" style="margin-top:5px;">Concepto o motivos de la solicitud:</label>
                    </div>
                </div>
                <div class="col-sm-9">
                    <el-input
                        type="textarea"
                        size="small"
                        :autosize="{ minRows: 2, maxRows: 4}"
                        placeholder="Llenar campo"
                        v-model="solicitud.MOTIVO">
                    </el-input>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:15px;">
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-3">
                    <div class="pull-right">
                        <label for="" style="margin-top:5px;">Medio de Pago :</label>
                    </div>
                </div>
                <div class="col-sm-5">
                    <el-select style="width:100%;" filterable clearable v-model="solicitud.MEDIO_PAGO" size="small" placeholder="Elija una Opción">
                        <el-option
                        v-for="item in data.medio"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                        </el-option>
                    </el-select>
                </div>
                <div class="col-sm-4">
                    <el-input  v-if="show.abono" type="text" size="small" v-model="solicitud.CUENTA"></el-input>
                    <el-input  v-if="!show.abono" type="text" size="small" v-model="solicitud.CHEQUE_NOMBRE"></el-input>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
             <div class="row" v-if="show.abono">
                <div class="col-sm-3">
                    <div class="pull-right">
                        <label for="" style="margin-top:5px;">Banco</label>
                    </div>
                </div>
                <div class="col-sm-9">
                    <el-select style="width:100%;" filterable clearable v-model="solicitud.BANCO_ID" size="small" placeholder="Elija una Opción">
                        <el-option
                        v-for="item in data.bancos"
                        :key="item.id"
                        :label="item.Nombre"
                        :value="item.id">
                        </el-option>
                    </el-select>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:15px;">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-4">
                    <div class="pull-right">
                        <label for="" style="margin-top:5px;">Tipo Solicitud</label>
                    </div>
                </div>
                <div class="col-sm-8">
                    <el-select style="width:100%;" clearable v-model="solicitud.TIPO_SOLICITUD_ID" filterable placeholder="Seleccionar Tipo Solicitud" size="small">
                        <el-option
                            v-for="item in data.tipoSolicitud"
                            :key="item.NOMBRE"
                            :label="item.NOMBRE"
                            :value="item.id">
                            <span style="float: left">@{{ item.NOMBRE}}</span>
                        </el-option>
                    </el-select>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
             <div class="row">
                <div class="col-sm-4">
                    <div class="pull-right">
                        <label for="">Centro de Costos</label>
                    </div>
                </div>
                <div class="col-sm-8">
                  <el-select style="width:100%;" clearable v-model="solicitud.CENTRO_COSTOS_ID" filterable placeholder="Seleccionar un Centro de Costo" size="small">
                      <el-option
                          v-for="item in data.centroCostos"
                          :key="item.NOMBRE"
                          :label="item.NOMBRE"
                          :value="item.id">
                          <span style="float: left">@{{ item.NOMBRE}}</span>
                      </el-option>
                  </el-select>
                </div>
            </div>
        </div>
    </div>
</div>
